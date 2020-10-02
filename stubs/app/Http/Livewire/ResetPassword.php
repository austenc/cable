<?php

namespace App\Http\Livewire;

use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Livewire\Component;

class ResetPassword extends Component
{
    public $email;
    public $password;
    public $password_confirmation;
    public $token;
    public $user;

    protected $rules = [
        'password' => 'min:8|confirmed',
        'password_confirmation' => 'required',
    ];

    public function mount($token)
    {
        $this->token = $token;
    }

    protected function credentials()
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
            'token' => $this->token,
        ];
    }

    public function resetPassword()
    {
        $status = Password::reset(
            $this->credentials(),
            function ($user, $password) {
                $user->forceFill(['password' => Hash::make($password)])->save();
                $user->setRememberToken(Str::random(60));
                event(new PasswordReset($user));
                $this->user = $user;
            }
        );
        if ($status === Password::PASSWORD_RESET) {
            Auth::login($this->user);
            $this->redirect(RouteServiceProvider::HOME);
        } else {
            $this->addError('email', __($status));
        }
    }

    public function render()
    {
        return view('auth.reset-password')->layout('layouts.auth');
    }
}
