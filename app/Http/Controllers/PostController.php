<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

use function PHPSTORM_META\type;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // TODO: use cache here, and others controllers.
    public function index()
    {
        $posts = Post::where('active', "=", true)
            ->whereDate('published_at', "<=", Carbon::now())
            ->with('categories')
            ->orderByDesc('published_at')
            ->paginate(16)
            ->onEachSide(2)
            ->through(fn ($post) => [
                "title" => $post->title,
                "slug" => $post->slug,
                "thumbnail" => $post->getThumbnail(),
                "body" => $post->body,
                'excerpt' => $post->excerpt(),
                "published_at" => $post->published_at,
                "categories" => $post->categories
            ]);

        return Inertia::render('Home/Home', [
            'posts' => $posts
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {

        $post = Post::where('slug', "=", $slug)
            ->with('categories')
            ->orderByDesc('published_at')
            ->paginate()
            ->map(fn ($post) => [
                "title" => $post->title,
                "slug" => $post->slug,
                "thumbnail" => $post->getThumbnail(),
                "body" => $post->body,
                "published_at" => $post->published_at,
                "categories" => $post->categories
            ]);

        $recent_posts = Post::where('active', "=", true)
            ->whereDate('published_at', "<=", Carbon::now())
            ->with('categories')
            ->orderByDesc('published_at')
            ->limit(5)
            ->paginate(4)
            ->map(fn ($post) => [
                "title" => $post->title,
                "slug" => $post->slug,
                "thumbnail" => $post->getThumbnail(),
                "body" => $post->body,
                "published_at" => $post->published_at,
                "categories" => $post->categories
            ]);

        if ($post->isEmpty()) {
            return redirect()->route('home');
        }

        return Inertia::render('Home/Post', [
            'post' => $post,
            'recent_posts' => $recent_posts,
        ]);
    }
}
