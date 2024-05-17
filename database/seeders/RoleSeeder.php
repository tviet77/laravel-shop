<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['name' => 'admin', 'display_name' => 'Admin'],
            ['name' => 'guest', 'display_name' => 'Khách hàng'],
            ['name' => 'dev', 'display_name' => 'Phát triển hệ thống'],
            ['name' => 'content', 'display_name' => 'Chỉnh sửa nội dung'],
        ]);
    }
}
