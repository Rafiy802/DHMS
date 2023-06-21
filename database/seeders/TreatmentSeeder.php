<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TreatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('treatments')->insert([
            'name' => 'Tooth Pick',
            'price' => 10,
        ]);

        DB::table('treatments')->insert([
            'name' => 'Treat 2',
            'price' => 5,
        ]);

        DB::table('treatments')->insert([
            'name' => 'Trick or Treat',
            'price' => 32,
        ]);
    }
}
