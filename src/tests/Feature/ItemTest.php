<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\User;
use App\Models\Like;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemTest extends TestCase
{
    use RefreshDatabase;

    // 商品一覧が表示される
    public function test_items_are_displayed()
    {
        $user = User::factory()->create();
        $other = User::factory()->create();

        Item::create([
            'user_id'      => $other->id,
            'name'         => 'テスト商品',
            'description'  => '説明',
            'price'        => 1000,
            'condition'    => '良好',
            'brand_name'   => '',
            'items_image'  => 'https://example.com/image.jpg',
            'item_comment' => '',
            'is_sold'      => false,
        ]);

        $response = $this->actingAs($user)->get('/');
        $response->assertSee('テスト商品');
    }

    // 自分の出品商品は一覧に表示されない
    public function test_own_items_are_not_displayed()
    {
        $user = User::factory()->create();

        Item::create([
            'user_id'      => $user->id,
            'name'         => '自分の商品',
            'description'  => '説明',
            'price'        => 1000,
            'condition'    => '良好',
            'brand_name'   => '',
            'items_image'  => 'https://example.com/image.jpg',
            'item_comment' => '',
            'is_sold'      => false,
        ]);

        $response = $this->actingAs($user)->get('/');
        $response->assertDontSee('自分の商品');
    }

    // マイリストにいいねした商品が表示される
    public function test_liked_items_appear_in_mylist()
    {
        $user  = User::factory()->create();
        $other = User::factory()->create();

        $item = Item::create([
            'user_id'      => $other->id,
            'name'         => 'いいね商品',
            'description'  => '説明',
            'price'        => 1000,
            'condition'    => '良好',
            'brand_name'   => '',
            'items_image'  => 'https://example.com/image.jpg',
            'item_comment' => '',
            'is_sold'      => false,
        ]);

        Like::create(['user_id' => $user->id, 'item_id' => $item->id]);

        $response = $this->actingAs($user)->get('/mylist');
        $response->assertSee('いいね商品');
    }

    // 未認証のマイリストは空
    public function test_mylist_is_empty_for_guest()
    {
        $response = $this->get('/mylist');
        $response->assertSee('表示する商品がありません');
    }

    // キーワード検索で商品が絞られる
    public function test_search_returns_matched_items()
    {
        $user  = User::factory()->create();
        $other = User::factory()->create();

        Item::create([
            'user_id'      => $other->id,
            'name'         => '腕時計',
            'description'  => '説明',
            'price'        => 1000,
            'condition'    => '良好',
            'brand_name'   => '',
            'items_image'  => 'https://example.com/image.jpg',
            'item_comment' => '',
            'is_sold'      => false,
        ]);

        Item::create([
            'user_id'      => $other->id,
            'name'         => 'ノートPC',
            'description'  => '説明',
            'price'        => 5000,
            'condition'    => '良好',
            'brand_name'   => '',
            'items_image'  => 'https://example.com/image.jpg',
            'item_comment' => '',
            'is_sold'      => false,
        ]);

        $response = $this->actingAs($user)->get('/?keyword=腕時計');
        $response->assertSee('腕時計');
        $response->assertDontSee('ノートPC');
    }

    // いいね機能
    public function test_user_can_like_item()
    {
        $user  = User::factory()->create();
        $other = User::factory()->create();

        $item = Item::create([
            'user_id'      => $other->id,
            'name'         => 'テスト商品',
            'description'  => '説明',
            'price'        => 1000,
            'condition'    => '良好',
            'brand_name'   => '',
            'items_image'  => 'https://example.com/image.jpg',
            'item_comment' => '',
            'is_sold'      => false,
        ]);

        $response = $this->actingAs($user)->post("/items/{$item->id}/like");
        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
    }

    // コメント機能
    public function test_user_can_comment_on_item()
    {
        $user  = User::factory()->create();
        $other = User::factory()->create();

        $item = Item::create([
            'user_id'      => $other->id,
            'name'         => 'テスト商品',
            'description'  => '説明',
            'price'        => 1000,
            'condition'    => '良好',
            'brand_name'   => '',
            'items_image'  => 'https://example.com/image.jpg',
            'item_comment' => '',
            'is_sold'      => false,
        ]);

        $response = $this->actingAs($user)->post("/items/{$item->id}/comments", [
            'content' => 'テストコメントです',
        ]);

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'content' => 'テストコメントです',
        ]);
    }
}
