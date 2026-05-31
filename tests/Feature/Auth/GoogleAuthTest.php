<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GoogleAuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test login screen can be rendered.
     */
    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    /**
     * Test register screen can be rendered.
     */
    public function test_register_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    /**
     * Test google redirect route returns redirect status.
     */
    public function test_google_redirect_route_returns_redirect(): void
    {
        $response = $this->get('/auth/google/redirect');

        $response->assertStatus(302);
        $this->assertStringContainsString('accounts.google.com', $response->headers->get('Location'));
    }

    /**
     * Test new user can register with valid recaptcha.
     */
    public function test_user_can_register_normal_with_recaptcha(): void
    {
        // Mock HTTP request ke Google API reCAPTCHA
        Http::fake([
            'https://www.google.com/recaptcha/api/siteverify' => Http::response(['success' => true], 200),
        ]);

        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'g-recaptcha-response' => 'valid-recaptcha-token',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }

    /**
     * Test google callback logs in existing user.
     */
    public function test_google_callback_logs_in_existing_user(): void
    {
        $user = User::factory()->create([
            'email' => 'mock-user@gmail.com',
        ]);

        // Kirim request ke Google callback dengan query parameter simulasi
        $response = $this->get('/auth/google/callback?google_id=mock-google-id-12345&email=mock-user@gmail.com&name=Mock+Google+User');

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(route('dashboard'));
        $this->assertEquals('mock-google-id-12345', $user->fresh()->google_id);
    }

    /**
     * Test google callback registers and logs in a new user.
     */
    public function test_google_callback_registers_new_user(): void
    {
        $response = $this->get('/auth/google/callback?google_id=mock-google-id-54321&email=new-mock-user@gmail.com&name=New+Mock+User');

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard'));
        
        $this->assertDatabaseHas('users', [
            'email' => 'new-mock-user@gmail.com',
            'google_id' => 'mock-google-id-54321',
            'name' => 'New Mock User',
        ]);
    }
}
