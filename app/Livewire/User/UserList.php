<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;

    public function delete(User $user): void
    {
        if ($user->id === auth()->id()) {
            session()->flash('error', 'Anda tidak bisa menghapus akun sendiri.');
            return;
        }

        $user->delete();
        session()->flash('success', 'User berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.user.user-list', [
            'users' => User::latest()->paginate(15),
        ]);
    }
}