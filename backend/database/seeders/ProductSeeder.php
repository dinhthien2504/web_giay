<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Lấy danh sách category id có sẵn
        $categories = Category::pluck('id');

        // Nếu chưa có danh mục nào thì dừng Seeder
        if ($categories->isEmpty()) {
            return;
        }

        Product::insert([
            [
                'category_id' => $categories->random(),
                'name' => 'Áo Thun Nam',
                'description' => 'Áo thun nam cotton thoáng mát.',
                'price' => 199000,
                'stock' => 50,
                'images' => 'images/ao-thun-nam.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $categories->random(),
                'name' => 'Quần Jean Nữ',
                'description' => 'Quần jean nữ form dáng ôm body đẹp.',
                'price' => 299000,
                'stock' => 30,
                'images' => 'images/quan-jean-nu.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $categories->random(),
                'name' => 'Áo Sơ Mi Nam',
                'description' => 'Áo sơ mi nam lịch lãm, sang trọng.',
                'price' => 259000,
                'stock' => 40,
                'images' => 'images/ao-so-mi-nam.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $categories->random(),
                'name' => 'Đầm Công Sở',
                'description' => 'Đầm công sở thanh lịch cho nữ.',
                'price' => 399000,
                'stock' => 20,
                'images' => 'images/dam-cong-so.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $categories->random(),
                'name' => 'Balo Thời Trang',
                'description' => 'Balo phong cách thời trang, tiện lợi.',
                'price' => 450000,
                'stock' => 15,
                'images' => 'images/balo-thoi-trang.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}

