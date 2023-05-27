<?php

namespace App\Http\Livewire\Users;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Delete extends Component
{
    public $user;
    public $password;
    public $openModal = false;

    protected $rules = [
        'password' => ['required', 'current_password'],
    ];

    public function render()
    {
        return view('livewire.users.delete');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function openModalToDeleteUser()
    {
        $this->reset('password');
        $this->resetErrorBag();
        $this->openModal = true;
    }

    public function delete()
    {
        $this->validate();
        $this->user->delete();

        $this->emit('updated', [
            'title'         => 'User deleted successfully!',
            'icon'          => 'success',
            'iconColor'     => 'green',
        ]);

        $this->emit('saved');
        $this->reset();
        $this->openModal = false;
    }
}
