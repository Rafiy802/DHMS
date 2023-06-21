<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('medicines')->insert([
            'price' => 20,
            'name' => 'rd-456',
            'quantity' => 10,
        ]);

        DB::table('medicines')->insert([
            'price' => 3,
            'name' => 'GG456',
            'quantity' => 20,
        ]);

        DB::table('medicines')->insert([
            'price' => 5,
            'name' => 'paracetamol',
            'quantity' => 200,
        ]);
    }
}
