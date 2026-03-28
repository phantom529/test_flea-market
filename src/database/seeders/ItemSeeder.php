<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'user_id'      => 1,
                'name'         => '腕時計',
                'description'  => 'スタイリッシュなデザインのメンズ腕時計',
                'price'        => 15000,
                'brand_name'   => 'Rolax',
                'condition'    => '良好',
                'items_image'  => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Armani+Mens+Clock.jpg',
                'item_comment' => '',
            ],
            [
                'user_id'      => 1,
                'name'         => 'HDD',
                'description'  => '高速で信頼性の高いハードディスク',
                'price'        => 5000,
                'brand_name'   => '西芝',
                'condition'    => '目立った傷や汚れなし',
                'items_image'  => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/HDD+Hard+Disk.jpg',
                'item_comment' => '',
            ],
            [
                'user_id'      => 1,
                'name'         => '玉ねぎ3束',
                'description'  => '新鮮な玉ねぎ3束のセット',
                'price'        => 300,
                'brand_name'   => '',
                'condition'    => 'やや傷や汚れあり',
                'items_image'  => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/iLoveIMG+d.jpg',
                'item_comment' => '',
            ],
            [
                'user_id'      => 1,
                'name'         => '革靴',
                'description'  => 'クラシックなデザインの革靴',
                'price'        => 4000,
                'brand_name'   => '',
                'condition'    => '状態が悪い',
                'items_image'  => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Leather+Shoes+Product+Photo.jpg',
                'item_comment' => '',
            ],
            [
                'user_id'      => 1,
                'name'         => 'ノートPC',
                'description'  => '高性能なノートパソコン',
                'price'        => 45000,
                'brand_name'   => '',
                'condition'    => '良好',
                'items_image'  => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Living+Room+Laptop.jpg',
                'item_comment' => '',
            ],
            [
                'user_id'      => 1,
                'name'         => 'マイク',
                'description'  => '高音質のレコーディング用マイク',
                'price'        => 8000,
                'brand_name'   => '',
                'condition'    => '目立った傷や汚れなし',
                'items_image'  => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Music+Mic+4632231.jpg',
                'item_comment' => '',
            ],
            [
                'user_id'      => 1,
                'name'         => 'ショルダーバッグ',
                'description'  => 'おしゃれなショルダーバッグ',
                'price'        => 3500,
                'brand_name'   => '',
                'condition'    => 'やや傷や汚れあり',
                'items_image'  => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Purse+fashion+pocket.jpg',
                'item_comment' => '',
            ],
            [
                'user_id'      => 1,
                'name'         => 'タンブラー',
                'description'  => '使いやすいタンブラー',
                'price'        => 500,
                'brand_name'   => '',
                'condition'    => '状態が悪い',
                'items_image'  => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Tumbler+souvenir.jpg',
                'item_comment' => '',
            ],
            [
                'user_id'      => 1,
                'name'         => 'コーヒーミル',
                'description'  => '手動のコーヒーミル',
                'price'        => 4000,
                'brand_name'   => 'Starbacks',
                'condition'    => '良好',
                'items_image'  => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Waitress+with+Coffee+Grinder.jpg',
                'item_comment' => '',
            ],
            [
                'user_id'      => 1,
                'name'         => 'メイクセット',
                'description'  => '便利なメイクアップセット',
                'price'        => 2500,
                'brand_name'   => '',
                'condition'    => '目立った傷や汚れなし',
                'items_image' => 'https://user0514.cdnw.net/shared/img/thumb/MS251_kosumesetsi_TP_V.jpg'
            ],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
