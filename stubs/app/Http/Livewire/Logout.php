<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Logout extends Component
{
    public function logout()
    {
        if (Auth::guest()) {
            return $this->redirect(route('login'));
        }

        Auth::logout();
        $this->redirect('/');
    }

    public function render()
    {
        return view('auth.logout')->layout('layouts.auth');
    }
}
