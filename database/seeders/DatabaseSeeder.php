<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Database\Factories\CategoryFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Edward J. Pineda',
            'email' => 'epineda@yopmail.com',
        ]);
        
        $this->call([
            CategorySeeder::class,
        ]);
        
        Branch::factory(10)->create();
        Product::factory(50)->create();
        Supplier::factory(50)->create();
    }
}
