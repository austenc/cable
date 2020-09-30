<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ForgotPassword extends Component
{
    public $email;
    public $message;

    protected $rules = [
        'email' => 'required|email',
    ];

    public function sendEmail()
    {
        $this->validate();
        $status = Password::sendResetLink(['email' => $this->email]);
        if ($status === Password::RESET_LINK_SENT) {
            $this->message = __($status);
        } else {
            $this->addError('email', __($status));
        }
    }

    public function render()
    {
        return view('auth.forgot-password')->layout('layouts.auth');
    }
}
