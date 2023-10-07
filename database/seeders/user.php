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
                'name' => 'Laila Nur Latifa',
                'username' => 'lailaNur',
                'password' =>  Hash::make('lailaNur'),
                'role' => '2',
                'id_guru' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Admin',
                'username' => 'admin',
                'password' =>  Hash::make('admin'),
                'role' => '1',
                'id_guru' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        DB::table('users')->insert($data);
    }
}
