<?php

namespace Tests\Feature;

use App\Http\Livewire\Logout;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_see_log_out_button()
    {
        $user = User::factory()->create();
        $this->actingAs($user)->get(RouteServiceProvider::HOME)->assertSeeLivewire('logout');
    }

    public function test_authenticated_user_can_log_out()
    {
        $user = User::factory()->create();
        Livewire::actingAs($user)
            ->test(Logout::class)
            ->call('logout')
            ->assertRedirect('/');
        $this->assertGuest();
    }

    public function test_guest_cannot_log_out()
    {
        Livewire::test(Logout::class)
            ->call('logout')
            ->assertRedirect(route('login'));
    }
}
