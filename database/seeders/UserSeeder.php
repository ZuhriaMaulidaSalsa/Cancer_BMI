<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $admin = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'ai' => '',
                'tlp' => '',
                'ttl' => '',
                'jk' => '',
                'password' => Hash::make('123456789'),
                'usertype' => 'admin',
            ],
            [
                'name' => 'Camelia',
                'email' => 'user@gmail.com',
                'ai' => 'SMA Surabaya',
                'tlp' => '089567845',
                'ttl' => '10-03-2003',
                'jk' => 'P',
                'password' => Hash::make('12345678'),
                'usertype' => 'user',
            ],
        ];

        DB::table('users')->insert($admin);
    }
}
