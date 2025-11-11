<?php

namespace App\Http\Controllers;

use App\Services\BlogService;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __construct(
        private BlogService $blogService
    ) {}

    /**
     * Generate sitemap.xml
     */
    public function index(): Response
    {
        $blogs = $this->blogService->getAllBlogs();

        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Homepage
        $sitemap .= '<url>';
        $sitemap .= '<loc>' . url('/') . '</loc>';
        $sitemap .= '<lastmod>' . now()->toAtomString() . '</lastmod>';
        $sitemap .= '<changefreq>weekly</changefreq>';
        $sitemap .= '<priority>1.0</priority>';
        $sitemap .= '</url>';

        // Blog index
        $sitemap .= '<url>';
        $sitemap .= '<loc>' . route('blog.index') . '</loc>';
        $sitemap .= '<lastmod>' . now()->toAtomString() . '</lastmod>';
        $sitemap .= '<changefreq>daily</changefreq>';
        $sitemap .= '<priority>0.9</priority>';
        $sitemap .= '</url>';

        // Blog posts
        foreach ($blogs as $blog) {
            $sitemap .= '<url>';
            $sitemap .= '<loc>' . route('blog.show', $blog['slug']) . '</loc>';
            $sitemap .= '<lastmod>' . date('c', strtotime($blog['date'])) . '</lastmod>';
            $sitemap .= '<changefreq>monthly</changefreq>';
            $sitemap .= '<priority>0.8</priority>';
            $sitemap .= '</url>';
        }

        $sitemap .= '</urlset>';

        return response($sitemap, 200)
            ->header('Content-Type', 'application/xml');
    }
}
