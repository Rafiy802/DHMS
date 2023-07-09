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
            'name' => 'Tooth Extraction',
            'price' => 10,
        ]);

        DB::table('treatments')->insert([
            'name' => 'Consultation',
            'price' => 5,
        ]);

        DB::table('treatments')->insert([
            'name' => 'Treatment 3',
            'price' => 32,
        ]);
    }
}
