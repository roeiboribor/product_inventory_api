<?php

namespace Database\Seeders;

use App\Models\InventoryLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventoryLevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('inventory_levels')->truncate();
        InventoryLevel::factory()->count(50)->create();
    }
}
