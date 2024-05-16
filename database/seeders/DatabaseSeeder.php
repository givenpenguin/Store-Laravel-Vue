<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Category::factory()->create([
            'title' => 'Футболки'
        ]);
        Category::factory()->create([
            'title' => 'Брюки'
        ]);
        Category::factory()->create([
            'title' => 'Худи'
        ]);

        Size::factory()->create([
            'title' => 'XS'
        ]);
        Size::factory()->create([
            'title' => 'S'
        ]);
        Size::factory()->create([
            'title' => 'M'
        ]);
        Size::factory()->create([
            'title' => 'L'
        ]);
        Size::factory()->create([
            'title' => 'XL'
        ]);

        Product::factory(100)->create();
    }
}
