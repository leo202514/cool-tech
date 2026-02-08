<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CoolTechSeeder extends Seeder
{
    public function run(): void
    {
        // Create an Admin User
        User::create([
            'name' => 'Default Admin',
            'email' => 'admin@cooltech.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Create a Writer User
        User::create([
            'name' => 'Tech Journalist',
            'email' => 'writer@cooltech.com',
            'password' => Hash::make('writer123'),
            'role' => 'writer',
        ]);

        // 1. Create Categories
        $categories = ['Tech news', 'Software reviews', 'Hardware reviews', 'Opinion pieces'];
        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat,
                'slug' => Str::slug($cat),
            ]);
        }

        // 2. Create Tags
        $tags = ['AI', 'Google', 'High-Performance Computing', 'Singularity', 'Linux'];
        foreach ($tags as $tagName) {
            Tag::create([
                'name' => $tagName,
                'slug' => Str::slug($tagName),
            ]);
        }

        // 3. Create Sample Articles
        $allCategories = Category::all();
        $allTags = Tag::all();

        for ($i = 1; $i <= 10; $i++) {
            $article = Article::create([
                'title' => "Cool Tech Article #$i",
                'content' => "This is the first paragraph of article $i. It contains digestible tech info.\n\nThis is the second paragraph with more depth.",
                'category_id' => $allCategories->random()->id,
                'created_at' => now()->subDays(rand(0, 10)),
            ]);

            $article->tags()->attach($allTags->random(rand(0, 3)));
        }
    }
}
