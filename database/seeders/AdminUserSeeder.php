<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      User::firstOrCreate(
            ['email' => 'chiara@admin.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('12345678'),
                'acesso' => 'Admin'
            ]
        );
    }
    
}
