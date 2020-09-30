<?php

namespace Tests\Feature;

use App\Http\Livewire\Login;
use App\Http\Livewire\ResetPassword;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Livewire\Livewire;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->token = Password::createToken($this->user);
    }

    public function test_can_see_forgot_password_form_with_valid_token()
    {
        $this->get(route('password.reset', $this->token))
            ->assertSeeLivewire('reset-password');
    }

    public function test_cant_reset_password_with_expired_token()
    {
        DB::table('password_resets')
            ->where('email', $this->user->email)
            ->update(['created_at' => now()->subDay()]);

        Livewire::test(ResetPassword::class, ['token' => $this->token])
            ->set('email', $this->user->email)
            ->set('password', 'newpassword')
            ->set('password_confirmation', 'newpassword')
            ->call('resetPassword')
            ->assertHasErrors('email')
            ->assertSee(__('passwords.token'));
    }

    public function test_email_must_match_token_to_reset_password()
    {
        Livewire::test(ResetPassword::class, ['token' => $this->token])
            ->set('email', 'other@example.com')
            ->set('password', 'newpassword')
            ->set('password_confirmation', 'newpassword')
            ->call('resetPassword')
            ->assertHasErrors('email')
            ->assertSee(__('passwords.user'));
    }

    public function test_user_can_reset_password_with_valid_token()
    {
        Livewire::test(ResetPassword::class, ['token' => $this->token])
            ->set('email', $this->user->email)
            ->set('password', 'newpassword')
            ->set('password_confirmation', 'newpassword')
            ->call('resetPassword')
            ->assertHasNoErrors()
            ->assertRedirect(RouteServiceProvider::HOME);

        Livewire::test(Login::class)
            ->set('email', $this->user->email)
            ->set('password', 'newpassword')
            ->call('login')
            ->assertRedirect(RouteServiceProvider::HOME);
    }
}
