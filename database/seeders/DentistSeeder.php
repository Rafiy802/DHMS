<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DentistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('dentists')->insert([
            'dentist_id' => 2,
            'user_id' => 2,
            'name' => 'Rafiy',
            'ICnum' => 'fseafw4rfw4fw',
        ]);

        DB::table('dentists')->insert([
            'dentist_id' => 3,
            'user_id' => 3  ,
            'name' => 'Lia',
            'ICnum' => 'egshhtsht3',
        ]);
    }
}
