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
    public function index()
    {
        $posts = Post::query()->where('active', "=", true)
            ->where('published_at', "!=", "NULL")->with('categories')
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
    public function show(string $id)
    {
        //
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
