<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Tambahkan import DB ini di atas
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'category_id' => 1,
                'category_name'=> 'Sneakers',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],[
                'category_id' => 2,
                'category_name'=> 'Sports',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);

        DB::table('products')->insert([
            [
                'product_id' => 1,
                'category_id' => 1,
                'product_name' => 'Nike Air Max',
                'product_price' => 150000,
                'product_stock' => 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);

    }
}
