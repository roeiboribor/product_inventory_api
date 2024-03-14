<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->truncate();

        foreach ($this->categories() as $key => $value) {
            Category::create(['name' => $value]);
        }
    }

    public function categories()
    {
        return [
            'Fashion',
            'Electronics',
            'Food',
            'DIY and Hardware',
            'Beverages',
            'Furniture',
            'Media',
        ];
    }
}
