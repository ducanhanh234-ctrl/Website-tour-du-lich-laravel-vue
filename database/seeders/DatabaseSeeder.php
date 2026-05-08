<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Tour;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tạo 100 Tours ngẫu nhiên
        Tour::factory(100)->create();

        // Tạo 20 Khách hàng
        // Customer::factory(20)->create();

        // Bạn có thể gọi các class Seeder riêng lẻ nếu bạn viết tách ra
        $this->call([
            // TourSeeder::class,
            // BookingSeeder::class,
        ]);
    }
}
