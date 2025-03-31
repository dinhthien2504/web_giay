<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Bill;

class BillSeeder extends Seeder
{
    public function run()
    {
        Bill::insert([
            [
                'user_id' => 1,
                'customer_name' => 'Nguyễn Văn A',
                'customer_email' => 'nguyenvana@example.com',
                'customer_phone' => '0123456789',
                'total' => 1200000,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'customer_name' => 'Trần Thị B',
                'customer_email' => 'tranthib@example.com',
                'customer_phone' => '0987654321',
                'total' => 850000,
                'status' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'customer_name' => 'Lê Minh C',
                'customer_email' => 'leminhc@example.com',
                'customer_phone' => '0933456789',
                'total' => 500000,
                'status' => 'cancelled',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'customer_name' => 'Hoàng Thị D',
                'customer_email' => 'hoangthid@example.com',
                'customer_phone' => '0967891234',
                'total' => 950000,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'customer_name' => 'Phạm Văn E',
                'customer_email' => 'phamvane@example.com',
                'customer_phone' => '0912345678',
                'total' => 2000000,
                'status' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
