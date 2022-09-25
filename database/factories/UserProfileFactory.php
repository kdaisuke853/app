<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'plan'=> $this->faker->randomElement(['regular', 'gold']),
            'sex'=>$this->faker->randomElement(['female', 'male']),
            'age'=>$this->faker->numberBetween(0, 100),
        ];
    }
}
