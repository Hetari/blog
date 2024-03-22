<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        return Inertia::render('Home/Home', [
            'posts' => Post::where('active', true)
                ->orderByDesc('created_at')
                ->paginate()
                ->through(fn ($post) => [
                    "title" => $post->title,
                    "slug" => $post->slug,
                    "thumbnail" => $post->thumbnail,
                    "body" => $post->body,
                ])
        ]);
    }
}
