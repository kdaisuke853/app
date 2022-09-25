<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'lesson_id'=> function(){
                return Lesson::factory()->create()->id;
            },
            'user_id'=> function(){
                return User::factory()->create()->id;
            },
        ];
    }
}
