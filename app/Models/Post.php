<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    // protected $fillable = [
    //     "title",
    //     "slug",
    //     "thumbnail",
    //     "body",
    //     "active",
    //     "published_at",
    //     "user_id",
    //     "updated_at",
    //     "created_at",
    // ];

    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
