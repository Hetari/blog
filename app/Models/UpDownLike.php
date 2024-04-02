<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpDownLike extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_like',
        'is_dislike',
        'post_id',
        'user_id',
    ];
}
