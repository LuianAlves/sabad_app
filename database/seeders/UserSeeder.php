<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = User::updateOrCreate(
            ['email' => 'teste@teste.com'],
            [
                'name'      => 'Teste admin',
                'password'  => Hash::make('teste123'),
                'is_active' => true,
            ]
        );

        $user->syncRoles(['admin']);
    }
}
