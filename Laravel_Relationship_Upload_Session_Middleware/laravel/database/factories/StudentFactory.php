<?php

namespace Database\Factories;

use App\Enums\StudentStatusEnum;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'gender' => $this->faker->boolean(),
            'birthdate' => $this->faker->dateTimeBetween('-30 years', '-18 years'),
            'status' => $this->faker->randomElement(StudentStatusEnum::getArrayView()),
            'course_id' => Course::query()->inRandomOrder()->value('id'),
        ];
    }
}
