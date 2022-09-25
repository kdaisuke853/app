<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $startAt = $this->faker->dateTimeBetween('+1 days', '+10 days');
        $startAt->setTime(10, 0, 0);
        $endAt = clone $startAt;
        $endAt->setTime(11, 0, 0);

        return [
            'name' => $this->faker->name,
            'coach_name' => $this->faker->name,
            'capacity' => $this->faker->randomNumber(2),
            'start_at' => $this->faker->dateTime,
            'end_at' => $this->faker->dateTime,
        ];
    }

    public function past()
    {
        return $this->state(function(array $attributes){
            $startAt = $this->faker->dateTimeBetween('+1 days', '+10 days');
            $startAt->setTime(10, 0, 0);
            $endAt = clone $startAt;
            $endAt->setTime(11, 0, 0);

            return[
                'start_at' => $startAt->format('Y-m-d H:i:s'),
                'end_at' => $endAt->format('Y-m-d H:i:s'),
            ];
        });
    }
}
