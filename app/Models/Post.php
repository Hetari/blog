<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

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
        "meta_title",
        "meta_description",
    ];

    // protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_post');
    }

    public function likes()
    {
        return $this->hasMany(UpDownLike::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function excerpt(): string
    {
        return Str::words(strip_tags($this->body), 50);
    }

    public function getThumbnail()
    {
        if (str_starts_with($this->thumbnail, "http")) {
            return $this->thumbnail;
        }
        //  "/storage/" . $this->thumbnail
        return asset("/storage/" . $this->thumbnail);
    }

    public function humanReadTime(): Attribute
    {
        return new Attribute(
            get: function ($value, $attributes) {
                $words = Str::wordCount(strip_tags($attributes['body']));

                $minutes = ceil($words / 200);

                return $minutes . 'm';
            }
        );
    }
}
