<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostView;
use App\Models\UpDownLike;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use function PHPSTORM_META\type;

class PostController extends Controller
{
    /**
     * Sanitizes user data by returning non-sensitive attributes.
     *
     * @param User $user The user object to sanitize
     * @return array The sanitized user data
     */
    public function sanitizeUserData(User $user)
    {
        return [
            'name' => $user->name,
            'username' => $user->username,
            'email' => $user->email,
        ];
    }

    /**
     * Display a listing of the resource.
     */
    // TODO: use cache here, and others controllers.
    public function index()
    {
        $posts = Post::query()
            ->when(
                Request::input('search'),
                fn ($query, $search) => $query
                    ->where(
                        fn ($query) => $query
                            // search by the post body or title
                            ->where('body', 'like', "%{$search}%")
                            ->orWhere('title', 'like', "%{$search}%")

                            // search by the author name
                            ->orWhereHas('user', fn ($query) => $query->where('name', 'like', "%{$search}%"))

                            // search by the category title
                            ->orWhereHas(
                                'categories',
                                fn ($query) =>
                                $query->where('title', 'like', "%{$search}%")
                            )
                    )
            )
            ->where('active', "=", true)
            // Todo: fix this to use published_at
            // ->whereDate('published_at', "=", Carbon::now())
            ->with('categories')
            ->orderByDesc('published_at')
            ->paginate(16)
            ->withQueryString()
            ->onEachSide(2)
            ->through(fn ($post) => [
                "title" => $post->title,
                "slug" => $post->slug,
                "thumbnail" => $post->getThumbnail(),
                "body" => $post->body,
                'excerpt' => $post->excerpt(),
                "published_at" => $post->published_at,
                "categories" => $post->categories,
                "user" => $this->sanitizeUserData($post->user),
                "human_read_time" => $post->humanReadTime
            ]);

        return Inertia::render('Home/Home', [
            'posts' => $posts,
            // 'canLogin' => Route::has('login'),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        // $likes = UpDownLike::where('post_id', '=', $post->id)->get();
        $post = Post::where('slug', "=", $slug)
            ->with('categories')

            ->orderByDesc('published_at')
            ->paginate()
            ->map(fn ($post) => [
                "id" => $post->id,
                "title" => $post->title,
                "slug" => $post->slug,
                "thumbnail" => $post->getThumbnail(),
                "body" => $post->body,
                "published_at" => $post->published_at,
                "categories" => $post->categories,
                "user" => $this->sanitizeUserData($post->user),
                "meta_title" => $post->meta_title,
                "meta_description" => $post->meta_description,
                "likes" => UpDownLike::where('post_id', '=', $post->id)
                    ->get()
                    ->map(fn ($like) => [
                        'user_id' => $like->user_id,
                        'is_like' => $like->is_like,
                        'is_dislike' => $like->is_dislike,
                    ])
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
                'excerpt' => $post->excerpt(),
                "published_at" => $post->published_at,
                "categories" => $post->categories,
                "user" => $this->sanitizeUserData($post->user)
            ]);

        if ($post->isEmpty()) {
            return redirect()->route('home');
        }


        $user = request()->user();

        // TODO: if I keep refresh this page, it will create postView for every refresh, fix that by generate random token and save this in user cookies, and give it 1 hour lifetime, and every time the user will make in this page will considered a single view, and we will not create a a new view for the same user and agent for 1 hour.
        PostView::create([
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'post_id' => $post[0]['id'],
            'user_id' => $user?->id
        ]);

        return Inertia::render('Home/Post', [
            'post' => $post,
            'recent_posts' => $recent_posts,
            // 'canLogin' => Route::has('login'),
        ]);
    }

    public function userPosts(string $username)
    {
        $user = User::where('username', "=", $username)->first();
        $posts = Post::where('user_id', "=", $user->id)
            ->when(
                Request::input('search'),
                fn ($query, $search) => $query
                    ->where(
                        fn ($query) => $query
                            ->where('body', 'like', "%{$search}%")

                            ->orWhereHas(
                                'categories',
                                fn ($query) =>
                                $query->where('title', 'like', "%{$search}%")
                            )
                    )
            )
            ->where('active', "=", true)
            ->whereDate('published_at', "<=", Carbon::now())
            ->with('categories')
            ->orderByDesc('published_at')
            ->paginate()
            ->onEachSide(2)
            ->through(fn ($post) => [
                "title" => $post->title,
                "slug" => $post->slug,
                "thumbnail" => $post->getThumbnail(),
                "body" => $post->body,
                'excerpt' => $post->excerpt(),
                "published_at" => $post->published_at,
                "categories" => $post->categories,
                "user" => $this->sanitizeUserData($post->user)

            ]);

        return Inertia::render('Home/Home', [
            'posts' => $posts
        ]);
    }

    public function vote(string $slug)
    {
        // $likes = request()->likes;
        $isLike = (bool) request()->isLike;
        $isDislike = (bool) request()->isDislike;

        $userID = auth()->id();

        $post = Post::where('slug', "=", $slug)
            ->with("likes")
            ->first();

        $like = UpDownLike::where("post_id", "=", $post->id)
            ->where("user_id", "=", $userID)
            ->first();

        if (!$like) {
            $like = UpDownLike::create([
                "user_id" => $userID,
                "post_id" => $post->id,
                "is_like" => $isLike,
                "is_dislike" => $isDislike
            ]);
        } else {
            $like->update([
                "is_like" => $isLike,
                "is_dislike" => $isDislike
            ]);
        }

        $like->save();
    }
}
