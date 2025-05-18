<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = User::firstOrCreate([
            'name' => 'Teste admin',
            'email' => 'teste@teste.com',
            'password' => bcrypt('teste123'),
            'is_active' => true,
        ])->assignRole('admin');
    }
}
