<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            '本',
            'ファッション',
            '家電',
            'ゲーム',
            'スポーツ'
        ];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}
