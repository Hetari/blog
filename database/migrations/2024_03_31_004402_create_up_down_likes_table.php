<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('up_down_likes', function (Blueprint $table) {
            $table->id();
            $table->boolean("is_like");
            $table->foreignId("post_id")->references("id")->on("posts")->cascadeOnDelete();
            $table->foreignId("user_id")->references("id")->on("users")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('up_down_likes');
    }
};
