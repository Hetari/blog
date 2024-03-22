<?php

use App\Models\User;
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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string("title", 2048);
            $table->string("slug", 2048);
            $table->string("thumbnail", 2048)->nullable();
            $table->longText("body");
            $table->boolean("active");
            $table->datetime("published_at");
            $table->foreignIdFor(User::class, "user_id");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("posts", function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('posts');
    }
};
