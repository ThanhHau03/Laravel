<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Course::factory(10)->create();
        Student::factory(10)->create();
        $this->call([
            UserSeeder::class,
        ]);
    }
}
