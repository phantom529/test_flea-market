<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{

public function run(): void
    {
        Item::create([
            'user_id' => 1,
            'name' => 'サンプル本',
            'description' => 'これはサンプル商品です',
            'price' => 1500,
            'brand_name' => 'サンプルブランド',
            'condition' => '良好',
            'items_image' => 'items/sample.jpg',
            'item_comment' => 'サンプルコメントです',
        ]);

    Item::create([
        'user_id' => 1,
        'name' => 'サンプルシャツ',
        'description' => 'シャツです',
        'price' => 3000,
        'brand_name' => 'サンプルブランド',
        'condition' => '良好',
        'items_image' => 'items/sample.jpg',
        'item_comment' => 'サンプルコメントです',
    ]);
    }
}
