<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon; 

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
   public function run(): void
    {
        // Users
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Hafizhah',
            'email' => 'hafizah@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'user',
        ]);

        // Brands
        DB::table('brands')->insert([
            [
                'nama_brand' => 'TumblrVault Pro',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_brand' => 'AquaCore',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_brand' => 'ThermoBrew',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_brand' => 'EcoVacuum',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        DB::table('categories')->insert([
            [
                'category_name' => 'Stainless Steel',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_name' => 'Double Wall',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_name' => 'Keramik',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_name' => 'Bambu',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_name' => 'Plastik BPA-Free',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_name' => 'Titanium',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_name' => 'Borosilikat / Kaca',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        DB::table('products')->insert([
            [
                'category_id' => 1,
                'brand_id' => 2,
                'product_name' => 'AquaCore Pro 750ml',
                'product_price' => 185000,
                'product_stock' => 15,
                'product_image' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 2,
                'brand_id' => 1,
                'product_name' => 'TumblrVault Double Wall 600ml',
                'product_price' => 225000,
                'product_stock' => 12,
                'product_image' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 1,
                'brand_id' => 3,
                'product_name' => 'ThermoBrew Stainless 800ml',
                'product_price' => 195000,
                'product_stock' => 8,
                'product_image' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 2,
                'brand_id' => 4,
                'product_name' => 'EcoVacuum Ultra 650ml',
                'product_price' => 245000,
                'product_stock' => 20,
                'product_image' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 3,
                'brand_id' => 2,
                'product_name' => 'AquaCore Ceramic 500ml',
                'product_price' => 165000,
                'product_stock' => 10,
                'product_image' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
