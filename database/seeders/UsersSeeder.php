<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'name' => 'DONI',
                'nip' => '1234',
                'email' => 'doni@email',
                'jabatan' => 'DIREKTUR',
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'DONO',
                'nip' => '1235',
                'email' => 'dono@email',
                'jabatan' => 'FINANCE',
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'DONA',
                'nip' => '1236',
                'email' => 'dona@email',
                'jabatan' => 'STAFF',
                'password' => Hash::make('123456'),
            ],
        ];
        User::insert($data);  
    }
}