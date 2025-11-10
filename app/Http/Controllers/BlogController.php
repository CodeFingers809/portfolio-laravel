<?php

namespace App\Http\Controllers;

use App\Services\BlogService;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class BlogController extends Controller
{
    public function __construct(
        private BlogService $blogService
    ) {}

    /**
     * Display all blogs
     */
    public function index()
    {
        $blogs = $this->blogService->getAllBlogs();

        return view('blog.index', compact('blogs'));
    }

    /**
     * Display a single blog
     */
    public function show(string $slug)
    {
        $blog = $this->blogService->getBlogBySlug($slug);

        if (!$blog) {
            abort(404, 'Blog not found');
        }

        return view('blog.show', compact('blog'));
    }

    /**
     * Serve blog assets (images, downloads)
     */
    public function asset(string $slug, string $type, string $filename): BinaryFileResponse
    {
        $allowedTypes = ['images', 'downloads'];

        if (!in_array($type, $allowedTypes)) {
            abort(404);
        }

        $path = storage_path("app/blogs/{$slug}/{$type}/{$filename}");

        if (!File::exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }
}
