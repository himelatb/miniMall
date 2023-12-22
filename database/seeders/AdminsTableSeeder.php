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
            'name' => 'Admin Mollah',
            'mobile' => 3422222,
            'email' => 'admin@admin.com',
            'password' => Hash::make(123),
            'status' => 2,
            'type' => 1,
            ],
            [
                'name' => 'Himel JJ',
                'mobile' => 31211,
                'email' => 'himel@admin.com',
                'password' => Hash::make(123),
                'status' => 2,
                'type' => 2,
            ],
            [
            'name' => 'Admin2 Mollah',
            'mobile' => 341,
            'email' => 'admin2@admin.com',
            'password' => Hash::make(123),
            'status' => 1,
            'type' => 2,
            ],
            [
                'name' => 'Admin3 Jilly',
                'mobile' => 222,
                'email' => 'Admin3@admin.com',
                'password' => Hash::make(123),
                'status' => 1,
                'type' => 1,
            ],
        ];
        Admin::insert($adminRecords);
    }
}
