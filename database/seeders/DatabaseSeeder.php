<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\WhiteLabelSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'phone' => '1234567890',
            'address' => '123 Admin Street',
            'city' => 'Admin City',
            'state' => 'Admin State',
            'zip_code' => '12345',
        ]);

        // Create Test User
        User::create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'phone' => '9876543210',
            'address' => '456 User Avenue',
            'city' => 'User City',
            'state' => 'User State',
            'zip_code' => '54321',
        ]);

        // Create Categories
        $categories = [
            ['name' => 'Electronics', 'description' => 'Electronic devices and gadgets'],
            ['name' => 'Clothing', 'description' => 'Fashion and apparel'],
            ['name' => 'Books', 'description' => 'Books and literature'],
            ['name' => 'Home & Garden', 'description' => 'Home decor and garden supplies'],
            ['name' => 'Sports', 'description' => 'Sports equipment and accessories'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'is_active' => true,
            ]);
        }

        // Create Products
        $products = [
            [
                'category_id' => 1,
                'name' => 'Laptop Pro 15',
                'description' => 'High-performance laptop with 16GB RAM and 512GB SSD',
                'price' => 1299.99,
                'sale_price' => 1199.99,
                'stock' => 50,
                'sku' => 'LAP-PRO-15',
            ],
            [
                'category_id' => 1,
                'name' => 'Wireless Mouse',
                'description' => 'Ergonomic wireless mouse with precision tracking',
                'price' => 29.99,
                'stock' => 100,
                'sku' => 'MOUSE-WL-01',
            ],
            [
                'category_id' => 1,
                'name' => 'Mechanical Keyboard',
                'description' => 'RGB mechanical keyboard with cherry MX switches',
                'price' => 149.99,
                'sale_price' => 129.99,
                'stock' => 75,
                'sku' => 'KB-MECH-RGB',
            ],
            [
                'category_id' => 2,
                'name' => 'Cotton T-Shirt',
                'description' => '100% cotton comfortable t-shirt',
                'price' => 19.99,
                'stock' => 200,
                'sku' => 'TSHIRT-COT-01',
            ],
            [
                'category_id' => 2,
                'name' => 'Denim Jeans',
                'description' => 'Classic blue denim jeans',
                'price' => 49.99,
                'sale_price' => 39.99,
                'stock' => 150,
                'sku' => 'JEANS-DEN-01',
            ],
            [
                'category_id' => 3,
                'name' => 'Programming Guide',
                'description' => 'Complete guide to modern programming',
                'price' => 39.99,
                'stock' => 80,
                'sku' => 'BOOK-PROG-01',
            ],
            [
                'category_id' => 3,
                'name' => 'Mystery Novel',
                'description' => 'Bestselling mystery thriller',
                'price' => 24.99,
                'sale_price' => 19.99,
                'stock' => 120,
                'sku' => 'BOOK-MYS-01',
            ],
            [
                'category_id' => 4,
                'name' => 'Garden Tool Set',
                'description' => 'Complete set of essential garden tools',
                'price' => 89.99,
                'stock' => 40,
                'sku' => 'GARDEN-TOOL-01',
            ],
            [
                'category_id' => 4,
                'name' => 'LED Table Lamp',
                'description' => 'Modern LED desk lamp with adjustable brightness',
                'price' => 34.99,
                'sale_price' => 29.99,
                'stock' => 90,
                'sku' => 'LAMP-LED-01',
            ],
            [
                'category_id' => 5,
                'name' => 'Yoga Mat',
                'description' => 'Non-slip yoga mat with carrying strap',
                'price' => 29.99,
                'stock' => 110,
                'sku' => 'YOGA-MAT-01',
            ],
            [
                'category_id' => 5,
                'name' => 'Dumbell Set',
                'description' => 'Adjustable dumbell set 5-25kg',
                'price' => 79.99,
                'sale_price' => 69.99,
                'stock' => 60,
                'sku' => 'DUMB-SET-01',
            ],
            [
                'category_id' => 1,
                'name' => 'Smartphone X',
                'description' => '5G smartphone with 128GB storage',
                'price' => 699.99,
                'sale_price' => 649.99,
                'stock' => 85,
                'sku' => 'PHONE-X-128',
                'is_featured' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create([
                'category_id' => $product['category_id'],
                'name' => $product['name'],
                'slug' => Str::slug($product['name']),
                'description' => $product['description'],
                'price' => $product['price'],
                'sale_price' => $product['sale_price'] ?? null,
                'stock' => $product['stock'],
                'sku' => $product['sku'],
                'is_active' => true,
                'is_featured' => $product['is_featured'] ?? false,
            ]);
        }

        // Create White Label Settings
        WhiteLabelSetting::create([
            'site_name' => 'White Label Store',
            'primary_color' => '#007bff',
            'secondary_color' => '#6c757d',
            'contact_email' => 'contact@whitelabelstore.com',
            'contact_phone' => '+1 (555) 123-4567',
            'footer_text' => '© 2024 White Label Store. All rights reserved.',
        ]);
    }
}
