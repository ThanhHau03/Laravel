<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'name' => 'Admin',
            'level' => '0',
            'email' => 'admin@gamil.com',
            'password' => '123',
        ];

        User::query()->create($data);

        $data = [
            'name' => 'Supper Admin',
            'level' => '1',
            'email' => 'sadmin@gamil.com',
            'password' => '123',
        ];

        User::query()->create($data);
    }
}
