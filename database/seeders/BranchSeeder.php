<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         $branches = [
            [
                'id' => 1,
                'name' => 'Main',
                'branch_code' => '00',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'name' => 'Jeddah',
                'branch_code' => '01',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'name' => 'Khamis',
                'branch_code' => '04',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 4,
                'name' => 'Riyadh',
                'branch_code' => '09',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        Branch::insert($branches);
    }
}
