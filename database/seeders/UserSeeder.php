<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = [
            [
                'id' => 1,
                'name' => 'rolandwms',
                'password' => Hash::make('rolandwms10'),
                'token' => '',
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'name' => 'Demo User',
                'password' => Hash::make('123456'),
                'role' => 'demo',
                'token' => '',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        User::insert($users);
    }
}
