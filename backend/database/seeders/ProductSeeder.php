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
                'category_id' => 1,
                'name' => 'Giày Thể Thao Nam Nike Air Max',
                'description' => 'Giày thể thao nam Nike Air Max với thiết kế năng động, êm ái, phù hợp cho chạy bộ và tập luyện.',
                'price' => 1990000,
                'stock' => 50,
                'image' => 'shoe1.jpg'
            ],
            [
                'category_id' => 1,
                'name' => 'Giày Sneaker Adidas Ultraboost',
                'description' => 'Giày sneaker Adidas Ultraboost cao cấp, phù hợp đi chơi và chạy bộ với công nghệ đệm Boost siêu nhẹ.',
                'price' => 2990000,
                'stock' => 40,
                'image' => 'shoe2.jpg'
            ],
            [
                'category_id' => 1,
                'name' => 'Giày Lười Nam Da Bò Cao Cấp',
                'description' => 'Giày lười nam làm từ da bò thật, mang lại vẻ lịch lãm, sang trọng và thoải mái khi sử dụng.',
                'price' => 2490000,
                'stock' => 60,
                'image' => 'shoe3.jpg'
            ],
            [
                'category_id' => 1,
                'name' => 'Giày Bóng Đá Nike Mercurial',
                'description' => 'Giày đá bóng Nike Mercurial dành cho sân cỏ nhân tạo, giúp tăng tốc và kiểm soát bóng tốt hơn.',
                'price' => 2190000,
                'stock' => 30,
                'image' => 'shoe4.jpg'
            ],
            [
                'category_id' => 1,
                'name' => 'Giày Tây Công Sở Oxford',
                'description' => 'Giày tây công sở kiểu Oxford, làm từ da bò thật, phù hợp cho doanh nhân và dân văn phòng.',
                'price' => 2790000,
                'stock' => 55,
                'image' => 'shoe5.jpg'
            ],
            [
                'category_id' => 1,
                'name' => 'Giày Converse Chuck Taylor Classic',
                'description' => 'Giày Converse Chuck Taylor Classic phong cách cổ điển, phù hợp với mọi outfit dạo phố.',
                'price' => 1890000,
                'stock' => 70,
                'image' => 'shoe6.jpg'
            ],
            [
                'category_id' => 1,
                'name' => 'Giày Vans Old Skool Đen Trắng',
                'description' => 'Giày Vans Old Skool với thiết kế đặc trưng, phù hợp cho những ai yêu thích phong cách streetwear.',
                'price' => 3090000,
                'stock' => 45,
                'image' => 'shoe7.jpg'
            ],
            [
                'category_id' => 1,
                'name' => 'Giày Chạy Bộ Puma Velocity',
                'description' => 'Giày chạy bộ Puma Velocity nhẹ và bám đường tốt, giúp cải thiện hiệu suất chạy bộ hàng ngày.',
                'price' => 1990000,
                'stock' => 80,
                'image' => 'shoe8.jpg'
            ],
            [
                'category_id' => 1,
                'name' => 'Giày Jordan 1 Retro High OG',
                'description' => 'Giày thể thao Jordan 1 Retro High OG mang phong cách huyền thoại, dành cho fan sneaker chính hiệu.',
                'price' => 2690000,
                'stock' => 35,
                'image' => 'shoe9.jpg'
            ]
        ]);

    }
}

