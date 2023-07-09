<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
            'name' => 'raffiy',
            'address' => 'KDOJ',
            'birthdate' => Carbon::createFromFormat('Y-m-d', '2023-05-17'),
            'mobile_num' => '0198028321',
            'role' => 1,
            'email' => 'raff@gmail.com',
            'password' => Hash::make('12121212')
        ]);

        DB::table('users')->insert([
            'name' => 'Rafiy',
            'address' => 'dfagdfbndbsvasv',
            'birthdate' => Carbon::createFromFormat('Y-m-d', '2023-05-04'),
            'mobile_num' => '12242312',
            'role' => 2,
            'email' => 'Rafiy@gmail.com',
            'password' => Hash::make('12121212')
        ]);

        DB::table('users')->insert([
            'name' => 'Lia',
            'address' => 'shivbwhiabi',
            'birthdate' => Carbon::createFromFormat('Y-m-d', '2023-05-19'),
            'mobile_num' => '8074302482321',
            'role' => 2,
            'email' => 'lia@gmail.com',
            'password' => Hash::make('12121212')
        ]);

        DB::table('users')->insert([
            'name' => 'Receptionist',
            'address' => 'ofwfgbaebfbiasa',
            'birthdate' => Carbon::createFromFormat('Y-m-d', '2023-05-21'),
            'mobile_num' => '246256454',
            'role' => 0,
            'email' => 'receptionist@gmail.com',
            'password' => Hash::make('12121212')
        ]);
    }
}
