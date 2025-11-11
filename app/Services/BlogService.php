<?php

namespace App\Services;

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\Extension\Attributes\AttributesExtension;
use League\CommonMark\MarkdownConverter;
use Illuminate\Support\Facades\File;
use Symfony\Component\Yaml\Yaml;

class BlogService
{
    private MarkdownConverter $converter;
    private string $blogsPath;

    public function __construct()
    {
        // Configure CommonMark with GFM extension
        $environment = new Environment([
            'html_input' => 'allow',
            'allow_unsafe_links' => false,
        ]);

        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new GithubFlavoredMarkdownExtension());
        $environment->addExtension(new AttributesExtension());

        $this->converter = new MarkdownConverter($environment);
        $this->blogsPath = storage_path('app/blogs');
    }

    /**
     * Get all blogs
     */
    public function getAllBlogs(): array
    {
        $blogs = [];

        if (!File::exists($this->blogsPath)) {
            return $blogs;
        }

        $directories = File::directories($this->blogsPath);

        foreach ($directories as $directory) {
            $slug = basename($directory);
            $blog = $this->getBlogBySlug($slug);

            if ($blog) {
                $blogs[] = $blog;
            }
        }

        // Sort by date, newest first
        usort($blogs, function ($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });

        return $blogs;
    }

    /**
     * Get a single blog by slug
     */
    public function getBlogBySlug(string $slug): ?array
    {
        $blogPath = $this->blogsPath . '/' . $slug;
        $contentPath = $blogPath . '/content.md';

        if (!File::exists($contentPath)) {
            return null;
        }

        $content = File::get($contentPath);

        // Parse front matter and content
        $parsed = $this->parseFrontMatter($content);

        // Convert markdown to HTML
        $html = $this->converter->convert($parsed['content'])->getContent();

        // Process image paths to use the blog.asset route
        $html = $this->processImagePaths($html, $slug);

        return [
            'slug' => $slug,
            'title' => $parsed['frontMatter']['title'] ?? 'Untitled',
            'date' => $parsed['frontMatter']['date'] ?? now()->toDateString(),
            'excerpt' => $parsed['frontMatter']['excerpt'] ?? '',
            'tags' => $parsed['frontMatter']['tags'] ?? [],
            'featured_image' => $parsed['frontMatter']['featured_image'] ?? null,
            'content' => $html,
            'raw_content' => $parsed['content'],
            'front_matter' => $parsed['frontMatter'],
        ];
    }

    /**
     * Process image paths in HTML to use the blog.asset route
     */
    private function processImagePaths(string $html, string $slug): string
    {
        // Replace image src attributes that start with "images/" or "downloads/"
        $html = preg_replace_callback(
            '/<img([^>]*)\ssrc="(images|downloads)\/([^"]+)"([^>]*)>/i',
            function ($matches) use ($slug) {
                $type = $matches[2];
                $filename = $matches[3];
                $url = route('blog.asset', [
                    'slug' => $slug,
                    'type' => $type,
                    'filename' => $filename
                ]);

                // Check if loading attribute already exists
                $hasLoading = stripos($matches[1] . $matches[4], 'loading=') !== false;
                $loadingAttr = $hasLoading ? '' : ' loading="lazy"';

                return '<img' . $matches[1] . ' src="' . $url . '"' . $matches[4] . $loadingAttr . '>';
            },
            $html
        );

        return $html;
    }

    /**
     * Parse front matter from markdown
     */
    private function parseFrontMatter(string $content): array
    {
        $frontMatter = [];
        $markdown = $content;

        // Check if content has front matter
        if (preg_match('/^---\s*\n(.*?)\n---\s*\n(.*)$/s', $content, $matches)) {
            $frontMatter = Yaml::parse($matches[1]);
            $markdown = $matches[2];
        }

        return [
            'frontMatter' => $frontMatter,
            'content' => $markdown,
        ];
    }

    /**
     * Get all images for a blog
     */
    public function getBlogImages(string $slug): array
    {
        $imagesPath = $this->blogsPath . '/' . $slug . '/images';

        if (!File::exists($imagesPath)) {
            return [];
        }

        return File::files($imagesPath);
    }

    /**
     * Get all downloadable resources for a blog
     */
    public function getBlogDownloads(string $slug): array
    {
        $downloadsPath = $this->blogsPath . '/' . $slug . '/downloads';

        if (!File::exists($downloadsPath)) {
            return [];
        }

        return File::files($downloadsPath);
    }

    /**
     * Get blog asset URL
     */
    public function getBlogAssetUrl(string $slug, string $type, string $filename): string
    {
        return route('blog.asset', [
            'slug' => $slug,
            'type' => $type,
            'filename' => $filename
        ]);
    }
}
