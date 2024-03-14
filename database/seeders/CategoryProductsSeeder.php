<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CategoryProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        DB::table('categories')->truncate();
        DB::table('products')->truncate();
        foreach ($this->categoriesWithProducts() as $item) {
            $category = Category::create(['name' => $item['category_name']]);
            $this->createProducts($item['products'], $category->id);
        }

        Schema::enableForeignKeyConstraints();
    }

    public function createProducts($products, $categoryId)
    {
        foreach ($products as $product) {
            Product::create([
                'category_id' => $categoryId,
                'name' => $product['name'],
                'description' => $product['description'],
                'price' => $product['price'],
            ]);
        }
    }

    public function categoriesWithProducts()
    {
        return
            [
                [
                    "category_name" => "Electronics",
                    "products" => [
                        ["name" => "Smartphone", "description" => "A powerful smartphone with the latest features", "price" => 599.99],
                        ["name" => "Laptop", "description" => "A high-performance laptop for all your computing needs", "price" => 1299.99],
                        ["name" => "Headphones", "description" => "Premium noise-canceling headphones for immersive audio experience", "price" => 199.99],
                        ["name" => "Tablet", "description" => "Compact tablet for on-the-go productivity", "price" => 349.99],
                        ["name" => "Smartwatch", "description" => "Smartwatch with fitness tracking and notifications", "price" => 199.99]
                    ]
                ],
                [
                    "category_name" => "Clothing",
                    "products" => [
                        ["name" => "T-Shirt", "description" => "Comfortable cotton t-shirt in various colors", "price" => 19.99],
                        ["name" => "Jeans", "description" => "Classic denim jeans for everyday wear", "price" => 39.99],
                        ["name" => "Hoodie", "description" => "Warm and stylish hoodie for chilly weather", "price" => 49.99],
                        ["name" => "Sneakers", "description" => "Versatile sneakers for casual outings", "price" => 59.99],
                        ["name" => "Dress Shirt", "description" => "Formal dress shirt for professional occasions", "price" => 29.99]
                    ]
                ],
                [
                    "category_name" => "Books",
                    "products" => [
                        ["name" => "The Great Gatsby", "description" => "A classic novel by F. Scott Fitzgerald", "price" => 9.99],
                        ["name" => "To Kill a Mockingbird", "description" => "Harper Lee's masterpiece exploring racial injustice", "price" => 12.99],
                        ["name" => "1984", "description" => "George Orwell's dystopian novel about totalitarianism", "price" => 14.99],
                        ["name" => "The Catcher in the Rye", "description" => "J.D. Salinger's iconic coming-of-age novel", "price" => 11.99],
                        ["name" => "Pride and Prejudice", "description" => "Jane Austen's timeless romantic novel", "price" => 10.99]
                    ]
                ]
            ];
    }
}
