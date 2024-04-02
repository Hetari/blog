<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

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

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $category = Category::factory()->create([
            'title' => 'test',
            'slug' => 'test',
            'color' => 'red'
        ]);

        $post = Post::factory()->create([
            'title' => 'test',
            'slug' => 'test',
            'thumbnail' => 'https://picsum.photos/200/300',
            'body' => 'test body',
            'active' => true,
            'user_id' => $user->id,
            'published_at' => Carbon::now(),
            'meta_title' => 'test',
            'meta_description' => 'test',
        ]);

        Post::factory(2)->create();



        $post->categories()->attach($category);

        $adminUser = User::factory()->create([
            'email' => 'admin@example.com',
            'name' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('admin'),
        ]);

        $adminRole = Role::create([
            'name' => 'admin',
        ]);

        $adminUser->assignRole($adminRole);
    }
}
