<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin Desa',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('Password123!'),
            'email_verified_at' => now(),
        ]);
    }
}
