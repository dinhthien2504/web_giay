<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bill;
use App\Models\Product;
use App\Models\BillDetail;

class BillDetailSeeder extends Seeder
{
    public function run()
    {
        // Lấy danh sách ID của hóa đơn và sản phẩm
        $bills = Bill::pluck('id');
        $products = Product::pluck('id');

        // Nếu chưa có dữ liệu trong bảng bills hoặc products thì không chạy Seeder
        if ($bills->isEmpty() || $products->isEmpty()) {
            return;
        }

        BillDetail::insert([
            [
                'bill_id' => $bills->random(),
                'product_id' => $products->random(),
                'quantity' => 2,
                'price' => 199000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bill_id' => $bills->random(),
                'product_id' => $products->random(),
                'quantity' => 1,
                'price' => 299000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bill_id' => $bills->random(),
                'product_id' => $products->random(),
                'quantity' => 3,
                'price' => 259000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bill_id' => $bills->random(),
                'product_id' => $products->random(),
                'quantity' => 1,
                'price' => 399000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bill_id' => $bills->random(),
                'product_id' => $products->random(),
                'quantity' => 4,
                'price' => 450000,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
