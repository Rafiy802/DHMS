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
            'price' => 5,
            'name' => 'Cataflam 50 mg',
            'quantity' => 10,
        ]);

        DB::table('medicines')->insert([
            'price' => 13,
            'name' => 'Mefinal 500 mg',
            'quantity' => 20,
        ]);

        DB::table('medicines')->insert([
            'price' => 15,
            'name' => 'Amoxillin 500 mg',
            'quantity' => 30,
        ]);
    }
}
