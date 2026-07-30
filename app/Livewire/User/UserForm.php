<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserForm extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $role = 'admin_finance';

    public function save(): void
    {
        $this->validate([
    'name' => 'required|min:2',
    'email' => 'required|email|unique:users,email',
    'password' => 'required|min:8',
    'role' => 'required|in:superadmin,admin_client,admin_finance,client',
]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,
            'email_verified_at' => now(),
        ]);

        session()->flash('success', 'User baru berhasil dibuat.');

        $this->redirectRoute('users.index');
    }

    public function render()
    {
        return view('livewire.user.user-form');
    }
}