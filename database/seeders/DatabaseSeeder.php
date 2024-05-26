<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\Size;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
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

        Role::factory()->create([
            'title' => 'Admin'
        ]);
        Role::factory()->create([
            'title' => 'Moderator'
        ]);
        Role::factory()->create([
            'title' => 'Manager'
        ]);

        Product::factory(10)->create();
        User::factory(10)->create();
    }
}
