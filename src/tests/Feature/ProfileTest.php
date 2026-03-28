<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    // プロフィール画面が表示される
    public function test_profile_screen_is_displayed()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/mypage/profile');
        $response->assertStatus(200);
    }

    // プロフィールを更新できる
    public function test_user_can_update_profile()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->put('/mypage/profile', [
            'username'    => '新しい名前',
            'postal_code' => '123-4567',
            'address'     => '大阪府大阪市1-1-1',
            'building'    => 'テストビル',
        ]);

        $response->assertRedirect('/mypage');
        $this->assertDatabaseHas('users', ['name' => '新しい名前']);
    }

    // 出品機能
    public function test_user_can_sell_item()
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $file = UploadedFile::fake()->createWithContent(
            'test.jpg',
            str_repeat(chr(0), 1024)
        );

        $response = $this->actingAs($user)->post('/sell', [
            'name'          => '出品テスト商品',
            'description'   => 'テスト説明',
            'price'         => 3000,
            'condition'     => '良好',
            'brand'         => 'テストブランド',
            'product_image' => $file,
        ]);

        $this->assertDatabaseHas('items', [
            'name'    => '出品テスト商品',
            'user_id' => $user->id,
        ]);
    }

    // 出品した商品がマイページに表示される
    public function test_sold_item_appears_in_mypage()
    {
        $user = User::factory()->create();

        Item::create([
            'user_id'      => $user->id,
            'name'         => '出品テスト商品',
            'description'  => 'テスト説明',
            'price'        => 3000,
            'condition'    => '良好',
            'brand_name'   => '',
            'items_image'  => 'https://example.com/image.jpg',
            'item_comment' => '',
            'is_sold'      => false,
        ]);

        $response = $this->actingAs($user)->get('/mypage');
        $response->assertSee('出品テスト商品');
    }
}
