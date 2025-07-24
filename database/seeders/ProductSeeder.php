<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Elektronik
            [
                'name' => 'iPhone 15 Pro',
                'description' => '6.1-inch display, A17 Pro chip, Pro camera system with 48MP Main camera',
                'price' => 999.99,
                'stock' => 50,
                'image_url' => 'https://picsum.photos/400/600?random=1',
                'category' => 'Elektronik',
                'is_active' => true,
            ],
            [
                'name' => 'Samsung Galaxy S24',
                'description' => '6.2-inch Dynamic AMOLED display, Snapdragon 8 Gen 3, 50MP camera',
                'price' => 849.99,
                'stock' => 40,
                'image_url' => 'https://picsum.photos/400/600?random=2',
                'category' => 'Elektronik',
                'is_active' => true,
            ],
            [
                'name' => 'MacBook Air M3',
                'description' => '13-inch laptop with M3 chip, 8GB RAM, 256GB SSD',
                'price' => 1199.99,
                'stock' => 25,
                'image_url' => 'https://picsum.photos/400/600?random=3',
                'category' => 'Elektronik',
                'is_active' => true,
            ],
            [
                'name' => 'AirPods Pro 2',
                'description' => 'Active Noise Cancellation, Spatial Audio, up to 30 hours battery',
                'price' => 249.99,
                'stock' => 80,
                'image_url' => 'https://picsum.photos/400/600?random=4',
                'category' => 'Elektronik',
                'is_active' => true,
            ],
            [
                'name' => 'iPad Air 5',
                'description' => '10.9-inch Liquid Retina display, M1 chip, 64GB WiFi',
                'price' => 599.99,
                'stock' => 30,
                'image_url' => 'https://picsum.photos/400/600?random=5',
                'category' => 'Elektronik',
                'is_active' => true,
            ],

            // Giyim
            [
                'name' => 'Nike Air Force 1',
                'description' => 'Classic white sneakers, leather upper, rubber sole',
                'price' => 90.00,
                'stock' => 100,
                'image_url' => 'https://picsum.photos/400/600?random=6',
                'category' => 'Giyim',
                'is_active' => true,
            ],
            [
                'name' => 'Levi\'s 501 Original Jeans',
                'description' => 'Classic straight fit jeans, 100% cotton, button fly',
                'price' => 69.99,
                'stock' => 75,
                'image_url' => 'https://picsum.photos/400/600?random=7',
                'category' => 'Giyim',
                'is_active' => true,
            ],
            [
                'name' => 'Adidas Hoodie',
                'description' => 'Comfortable cotton hoodie with kangaroo pocket',
                'price' => 55.00,
                'stock' => 60,
                'image_url' => 'https://picsum.photos/400/600?random=8',
                'category' => 'Giyim',
                'is_active' => true,
            ],
            [
                'name' => 'Champion T-Shirt',
                'description' => 'Basic cotton t-shirt, various colors available',
                'price' => 25.00,
                'stock' => 120,
                'image_url' => 'https://picsum.photos/400/600?random=9',
                'category' => 'Giyim',
                'is_active' => true,
            ],

            // Ev & Yaşam
            [
                'name' => 'Dyson V15 Vacuum',
                'description' => 'Cordless vacuum cleaner with laser detect technology',
                'price' => 749.99,
                'stock' => 20,
                'image_url' => 'https://picsum.photos/400/600?random=10',
                'category' => 'Ev & Yaşam',
                'is_active' => true,
            ],
            [
                'name' => 'Instant Pot Duo',
                'description' => '7-in-1 electric pressure cooker, 6 quart capacity',
                'price' => 99.95,
                'stock' => 35,
                'image_url' => 'https://picsum.photos/400/600?random=11',
                'category' => 'Ev & Yaşam',
                'is_active' => true,
            ],
            [
                'name' => 'Philips Hue Starter Kit',
                'description' => 'Smart lighting system with 3 bulbs and bridge',
                'price' => 199.99,
                'stock' => 45,
                'image_url' => 'https://picsum.photos/400/600?random=12',
                'category' => 'Ev & Yaşam',
                'is_active' => true,
            ],

            // Kitap
            [
                'name' => 'The Psychology of Programming',
                'description' => 'Classic book on software development psychology by Gerald Weinberg',
                'price' => 29.99,
                'stock' => 15,
                'image_url' => 'https://picsum.photos/400/600?random=13',
                'category' => 'Kitap',
                'is_active' => true,
            ],
            [
                'name' => 'Clean Code',
                'description' => 'A Handbook of Agile Software Craftsmanship by Robert C. Martin',
                'price' => 39.99,
                'stock' => 22,
                'image_url' => 'https://picsum.photos/400/600?random=14',
                'category' => 'Kitap',
                'is_active' => true,
            ],
            [
                'name' => 'The Pragmatic Programmer',
                'description' => 'Your journey to mastery by David Thomas and Andrew Hunt',
                'price' => 34.99,
                'stock' => 18,
                'image_url' => 'https://picsum.photos/400/600?random=15',
                'category' => 'Kitap',
                'is_active' => true,
            ],

            // Spor
            [
                'name' => 'Resistance Bands Set',
                'description' => '5 different resistance levels, door anchor included',
                'price' => 24.99,
                'stock' => 90,
                'image_url' => 'https://picsum.photos/400/600?random=16',
                'category' => 'Spor',
                'is_active' => true,
            ],
            [
                'name' => 'Yoga Mat',
                'description' => '6mm thick non-slip exercise mat with carrying strap',
                'price' => 35.00,
                'stock' => 65,
                'image_url' => 'https://picsum.photos/400/600?random=17',
                'category' => 'Spor',
                'is_active' => true,
            ],
            [
                'name' => 'Adjustable Dumbbells',
                'description' => 'Set of two 40lb adjustable dumbbells with multiple weight plates',
                'price' => 299.99,
                'stock' => 12,
                'image_url' => 'https://picsum.photos/400/600?random=18',
                'category' => 'Spor',
                'is_active' => true,
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
