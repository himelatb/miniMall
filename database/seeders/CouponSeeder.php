<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Coupon;
class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Coupon::insert([
            ['coupon_option' => 'Manual', 'coupon_code' => 'test10',
             'categories' => '1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11',
            'brands' => '1, 2', 'users' => '', 'coupon_type' => 'Single', 
            'amount_type' => 'Percentage', 'amount' => '10', 'expiry_date' => '2024-12-21'],
            ['coupon_option' => 'Manual', 'coupon_code' => 'test20',
            'categories' => '1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11',
           'brands' => '1, 2', 'users' => 'himel@gmail.com', 'coupon_type' => 'Single', 
           'amount_type' => 'Percentage', 'amount' => '20', 'expiry_date' => '2024-12-21'],
           ['coupon_option' => 'Automatic', 'coupon_code' => 'h32123df',
           'categories' => '1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11',
          'brands' => '1, 2', 'users' => '', 'coupon_type' => 'Multiple', 
          'amount_type' => 'Fixed', 'amount' => '100', 'expiry_date' => '2024-12-21'],
        ]);
    }
}
