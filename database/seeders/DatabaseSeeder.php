<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function getRandomUser($users)
    {
        // select 5 random users
        $rand = $users->random(5);

        // select one random from the 5
        return $rand->random();
    }
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
        $posts = Post::factory(50)->create();

        // Associate each post with one or more categories
        foreach ($posts as $post) {
            $post->user_id = $this->getRandomUser($users);

            // Randomly select a few categories for each post
            $categoriesForPost = $categories->random(mt_rand(1, 3));


            // Attach categories to the post
            $post->categories()->attach($categoriesForPost);
        }
    }
}
