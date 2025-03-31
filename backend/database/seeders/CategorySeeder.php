<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::insert([
            [
                'name' => 'Áo Nam',
                'description' => 'Danh mục các loại áo dành cho nam giới',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Áo Nữ',
                'description' => 'Danh mục các loại áo dành cho nữ giới',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Quần Nam',
                'description' => 'Danh mục các loại quần dành cho nam giới',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Quần Nữ',
                'description' => 'Danh mục các loại quần dành cho nữ giới',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Phụ Kiện',
                'description' => 'Danh mục các loại phụ kiện thời trang',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
