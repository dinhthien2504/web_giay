<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::insert([
            [
                'name' => 'Tài khoản 1',
                'email' => 'taikhoan1@gmail.com',
                'password' => '12345'
            ],
            [
                'name' => 'Tài khoản 2',
                'email' => 'taikhoan2@gmail.com',
                'password' => '12345'
            ]
        ]);
    }
}
