<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // TODO: use cache here
    public function index()
    {
        $posts = Post::where('active', "=", true)
            ->where('published_at', "!=", "NULL")
            ->with('categories')
            ->orderByDesc('published_at')
            ->paginate()
            ->through(fn ($post) => [
                "title" => $post->title,
                "excerpt" => $post->excerpt,
                "slug" => $post->slug,
                "thumbnail" => $post->thumbnail,
                "body" => $post->body,
                "published_at" => $post->published_at,
                "categories" => $post->categories
            ]);


        return Inertia::render('Home/Home', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)
            ->first()
            ->load('categories')
            ->only([
                'title',
                'body',
                'thumbnail',
                'published_at',
                'categories'
            ]);

        $recent_posts = Post::where('active', "=", true)
            ->where('published_at', "!=", "NULL")
            ->with('categories')
            ->orderByDesc('published_at')
            ->select([
                'title',
                'body',
                'thumbnail',
                'published_at',
                'excerpt',
                'slug'
            ])
            ->limit(5)
            ->get();

        return Inertia::render('Home/Post', [
            'post' => $post,
            'recent_posts' => $recent_posts,
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
