<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suppliers = [
            [

                'id' => 1,
                'name' => 'gsk',
                'image' => 'capsules',
                'brand' => '74',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [

                'id' => 2,
                'name' => 'aspen',
                'image' => 'tablets',
                'brand' => '85',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [

                'id' => 3,
                'name' => 'roche',
                'image' => 'vials',
                'brand' => '89',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [

                'id' => 4,
                'name' => 'atnahs',
                'image' => 'syringe',
                'brand' => '19',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [

                'id' => 5,
                'name' => 'msd',
                'image' => 'heart-pulse',
                'brand' => '09',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [

                'id' => 6,
                'name' => 'pharma',
                'image' => 'heart',
                'brand' => '79',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [

                'id' => 7,
                'name' => 'organon',
                'image' => 'pills',
                'brand' => '18',
                'created_at' => now(),
                'updated_at' => now()
            ]
    
        ];

        Supplier::insert($suppliers);
    }
}
