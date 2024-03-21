<?php

use App\Models\Category;
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
        Schema::create('category_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId("category_id")->references("id")->on("categories")->onDelete("cascade");
            $table->foreignId("post_id")->references("id")->on("posts")->onDelete("cascade");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("category_posts", function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('category_posts');
    }
};
