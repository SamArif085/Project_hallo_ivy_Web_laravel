<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class user extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Bagio',
                'username' => 'Bagio',
                'password' =>  Hash::make('bagio'),
                'role' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        DB::table('users')->insert($data);
    }
}
