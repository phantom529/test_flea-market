<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    // 会員登録
    public function test_user_can_register()
    {
        $response = $this->post('/register', [
            'name'                  => 'テストユーザー',
            'email'                 => 'test@example.com',
            'password'              => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    }

    // ログイン
    public function test_user_can_login()
    {
        $user = User::factory()->create([
            'email'    => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email'    => 'test@example.com',
            'password' => 'password123',
        ]);

        $this->assertAuthenticatedAs($user);
    }

    // ログアウト
    public function test_user_can_logout()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/logout');

        $this->assertGuest();
    }

    // 未入力での登録失敗
    public function test_register_fails_without_name()
    {
        $response = $this->post('/register', [
            'name'                  => '',
            'email'                 => 'test@example.com',
            'password'              => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors('name');
    }

    // メールアドレス未入力での登録失敗
    public function test_register_fails_without_email()
    {
        $response = $this->post('/register', [
            'name'                  => 'テスト',
            'email'                 => '',
            'password'              => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
    }

    // パスワード未入力での登録失敗
    public function test_register_fails_without_password()
    {
        $response = $this->post('/register', [
            'name'                  => 'テスト',
            'email'                 => 'test@example.com',
            'password'              => '',
            'password_confirmation' => '',
        ]);

        $response->assertSessionHasErrors('password');
    }

    // パスワード不一致での登録失敗
    public function test_register_fails_with_password_mismatch()
    {
        $response = $this->post('/register', [
            'name'                  => 'テスト',
            'email'                 => 'test@example.com',
            'password'              => 'password123',
            'password_confirmation' => 'different',
        ]);

        $response->assertSessionHasErrors('password');
    }

    // 未登録メールでのログイン失敗
    public function test_login_fails_with_wrong_email()
    {
        $response = $this->post('/login', [
            'email'    => 'notexist@example.com',
            'password' => 'password123',
        ]);

        $this->assertGuest();
    }

    // 間違いパスワードでのログイン失敗
    public function test_login_fails_with_wrong_password()
    {
        User::factory()->create([
            'email'    => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email'    => 'test@example.com',
            'password' => 'wrongpassword',
        ]);

        $this->assertGuest();
    }
}
