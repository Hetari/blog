<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'slug' => $this->faker->slug(),
            'thumbnail' => $this->faker->imageUrl(),
            'body' => "<p>" . implode("</p><p>", $this->faker->paragraphs(3)) . "</p>",
            'active' => $this->faker->boolean(),
            'published_at' => $this->faker->dateTimeThisMonth(),
            'user_id' => User::factory(),
        ];
    }
}
