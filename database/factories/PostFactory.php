<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => \App\Models\User::inRandomOrder()->first()->id,
            'title'   => $this->faker->sentence,
            'slug'    => $this->faker->slug(),
            'content' => $this->faker->text(1600),
        ];
    }
}
