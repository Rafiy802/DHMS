<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('patients')->insert([
            'patient_id' => 1,
            'user_id' => 1,
            'name' => 'rafff',
            'ICnum' => 'vsvvesfvdsvasd',
        ]);
    }
}
