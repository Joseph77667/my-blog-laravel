<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Blog::class;
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'intro' => fake()->sentence(),
            'slug' => fake()->slug(),
            'body'=>fake()->text(),
            'category_id'=>Category::factory(),
            'user_id'=>User::factory()
        ];
    }
}
