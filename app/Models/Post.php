<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "title",
        "slug",
        "thumbnail",
        "body",
        "active",
        "published_at",
        "user_id",
    ];

    // protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        // Generating excerpt before creating the post
        static::creating(function ($post) {
            // Strip HTML tags from the body before creating the excerpt
            $excerpt = strip_tags($post->body);
            // Trim the excerpt to desired length
            $post->excerpt = substr($excerpt, 0, 750); // Adjust the length of excerpt as needed
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_post');
    }
}
