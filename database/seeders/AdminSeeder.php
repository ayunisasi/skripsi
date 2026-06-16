<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nama_lengkap' => 'Admin Salon',
            'username'     => 'admin',
            'email'        => 'admin@srisalon.com',
            'password'     => Hash::make('admin123'),
            'no_telp'      => '081234567890',
            'role'         => 'admin',
        ]);
    }
}
