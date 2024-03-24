<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $users = User::factory(10)->create();
        $categories = Category::factory(10)->create();
        $posts = Post::factory(50)->create([
            'user_id' => $users->random()->id
        ]);

        // Associate each post with one or more categories
        foreach ($posts as $post) {
            // Randomly select a few categories for each post
            $categoriesForPost = $categories->random(mt_rand(1, 3));


            // Attach categories to the post
            $post->categories()->attach($categoriesForPost);
        }
    }
}
