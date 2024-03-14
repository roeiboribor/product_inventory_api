<?php

namespace Database\Seeders;

use App\Models\InventoryLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventoryLevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InventoryLevel::factory()->count(50)->create();
    }
}
