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
                'name' => 'Giày 1',
                'description' => 'Mô tả giày 1',
                'price' => 199000,
                'stock' => 50,
                'images' => 'shoe1.jpg'
            ],
            [
                'category_id' => $categories->random(),
                'name' => 'Giày 2',
                'description' => 'Mô tả giày 2',
                'price' => 199000,
                'stock' => 50,
                'images' => 'shoe2.jpg'
            ],
            [
                'category_id' => $categories->random(),
                'name' => 'Giày 3',
                'description' => 'Mô tả giày 3',
                'price' => 199000,
                'stock' => 50,
                'images' => 'shoe3.jpg'
            ],
            [
                'category_id' => $categories->random(),
                'name' => 'Giày 4',
                'description' => 'Mô tả giày 4',
                'price' => 199000,
                'stock' => 50,
                'images' => 'shoe4.jpg'
            ]
        ]);
    }
}

