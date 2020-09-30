<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Profile extends Component
{
    public User $user;
    public $password;
    public $password_confirmation;
    public $saved = false;

    protected $rules = [
        'user.name' => 'required',
        'user.email' => 'required|email',
    ];

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function updatedUserEmail()
    {
        $this->validateOnly('user.email', [
            'user.email' => 'required|email|unique:users,email,'.$this->user->id,
        ]);
    }

    public function save()
    {
        $this->validate();
        $this->user->save();
        $this->changePassword();
        $this->saved = true;
    }

    protected function changePassword()
    {
        // We only want to validate and update the password if it's not empty
        if (empty($this->password)) {
            return;
        }
        $this->validateOnly('password', ['password' => 'min:8|confirmed']);
        $this->user->update([
            'password' => Hash::make($this->password),
        ]);
        $this->password = null;
        $this->password_confirmation = null;
    }

    public function render()
    {
        return view('auth.profile');
    }
}
