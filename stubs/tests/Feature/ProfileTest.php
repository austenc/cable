<?php

namespace Tests\Feature;

use App\Http\Livewire\Profile;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_can_see_profile()
    {
        $this->actingAs($this->user)
            ->get('/profile')
            ->assertSeeLivewire('profile');
    }

    public function test_name_is_required()
    {
        Livewire::actingAs($this->user)->test(Profile::class)
            ->set('user.name', '')
            ->call('save')
            ->assertHasErrors(['user.name' => 'required']);
    }

    public function test_email_is_required()
    {
        Livewire::actingAs($this->user)->test(Profile::class)
            ->set('user.email', '')
            ->call('save')
            ->assertHasErrors(['user.email' => 'required']);
    }

    public function test_email_is_valid_email()
    {
        Livewire::actingAs($this->user)->test(Profile::class)
            ->set('user.email', 'invalid')
            ->call('save')
            ->assertHasErrors(['user.email' => 'email']);
    }

    public function test_email_is_unique()
    {
        User::factory()->create(['email' => 'test@example.com']);
        Livewire::actingAs($this->user)->test(Profile::class)
            ->set('user.email', 'test@example.com')
            ->assertHasErrors(['user.email' => 'unique']);
    }

    public function test_password_unchanged_when_left_blank()
    {
        Livewire::actingAs($this->user)->test(Profile::class)
            ->call('save');
        $this->assertTrue(Hash::check('password', $this->user->password));
    }

    public function test_must_confirm_new_password()
    {
        Livewire::actingAs($this->user)->test(Profile::class)
            ->set('password', 'newpassword')
            ->call('save')
            ->assertHasErrors(['password' => 'confirmed']);
    }

    public function test_can_change_password()
    {
        Livewire::actingAs($this->user)->test(Profile::class)
            ->set('password', 'newpassword')
            ->set('password_confirmation', 'newpassword')
            ->call('save');
        $this->assertTrue(Hash::check('newpassword', $this->user->refresh()->password));
    }

    public function test_profile_can_be_updated()
    {
        Livewire::actingAs($this->user)->test(Profile::class)
            ->set('user.name', 'Example')
            ->set('user.email', 'test@example.com')
            ->call('save');
        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'name' => 'Example',
            'email' => 'test@example.com',
        ]);
    }
}
