<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PurchaseTest extends TestCase
{
    use RefreshDatabase;

    private function createItem($userId)
    {
        return Item::create([
            'user_id'      => $userId,
            'name'         => 'テスト商品',
            'description'  => '説明',
            'price'        => 1000,
            'condition'    => '良好',
            'brand_name'   => '',
            'items_image'  => 'https://example.com/image.jpg',
            'item_comment' => '',
            'is_sold'      => false,
        ]);
    }

    // 購入画面が表示される
    public function test_purchase_screen_is_displayed()
    {
        $user  = User::factory()->create();
        $other = User::factory()->create();
        $item  = $this->createItem($other->id);

        $response = $this->actingAs($user)->get("/purchase/{$item->id}");
        $response->assertStatus(200);
        $response->assertSee('テスト商品');
    }

    // コンビニ払いで購入できる
    public function test_user_can_purchase_with_convenience()
    {
        $user  = User::factory()->create();
        $other = User::factory()->create();
        $item  = $this->createItem($other->id);

        $response = $this->actingAs($user)->post("/purchase/{$item->id}", [
            'payment_method' => 'convenience',
        ]);

        $this->assertDatabaseHas('purchases', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $item->refresh();
        $this->assertTrue((bool)$item->is_sold);
    }

    // 購入後に商品一覧にSOLD表示
    public function test_item_is_sold_after_purchase()
    {
        $user  = User::factory()->create();
        $other = User::factory()->create();
        $item  = $this->createItem($other->id);

        $this->actingAs($user)->post("/purchase/{$item->id}", [
            'payment_method' => 'convenience',
        ]);

        $item->refresh();
        $this->assertTrue((bool)$item->is_sold);
    }

    // 配送先変更が保存される
    public function test_address_can_be_changed()
    {
        $user  = User::factory()->create();
        $other = User::factory()->create();
        $item  = $this->createItem($other->id);

        $response = $this->actingAs($user)->post("/purchase/{$item->id}/address", [
            'postal_code'   => '123-4567',
            'address'       => '大阪府大阪市中央区1-1-1',
            'building_name' => 'テストビル',
        ]);

        $response->assertRedirect("/purchase/{$item->id}");
        $this->assertEquals('123-4567', session('purchase_postal_code'));
    }

    // 購入した商品がプロフィールに表示される
    public function test_purchased_item_appears_in_mypage()
    {
        $user  = User::factory()->create();
        $other = User::factory()->create();
        $item  = $this->createItem($other->id);

        $this->actingAs($user)->post("/purchase/{$item->id}", [
            'payment_method' => 'convenience',
        ]);

        $response = $this->actingAs($user)->get('/mypage');
        $response->assertSee('テスト商品');
    }
}
