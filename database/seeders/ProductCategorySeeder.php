<?php

namespace Database\Seeders;

use App\Models\Categories;
use App\Models\product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the products and categories table.
     */
    public function run(): void
    {
        // Create Categories
        $elektronik = Categories::create(['name' => 'Elektronik']);
        $gaming = Categories::create(['name' => 'Gaming']);
        $aksesoris = Categories::create(['name' => 'Aksesoris']);

        // Create Products
        $laptopGaming = product::create([
            'name' => 'Laptop Gaming',
            'description' => 'Laptop gaming dengan spesifikasi tinggi',
            'price' => 15000000,
            'stock' => 10,
            'sku' => 'LAPTOP-GAMING-001',
        ]);
        $mouse = product::create([
            'name' => 'Mouse',
            'description' => 'Mouse gaming dengan DPI tinggi',
            'price' => 500000,
            'stock' => 50,
            'sku' => 'MOUSE-GAMING-001',
        ]);

        // Attach categories to products (Many-to-Many relationship)
        // Laptop Gaming memiliki kategori Elektronik dan Gaming
        $laptopGaming->categories()->attach([
            $elektronik->id,
            $gaming->id,
        ]);

        // Mouse memiliki kategori Elektronik dan Aksesoris
        $mouse->categories()->attach([
            $elektronik->id,
            $aksesoris->id,
        ]);
    }
}
