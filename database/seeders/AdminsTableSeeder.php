<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRecords = [
            [
            'name' => 'admin',
            'mobile' => 3422222,
            'email' => 'admin@admin.com',
            'password' => Hash::make(123),
            'status' => 1,
            'type' => 1,
            ],
        ];
        Admin::insert($adminRecords);
    }
}
