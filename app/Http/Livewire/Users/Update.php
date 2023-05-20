<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use Illuminate\Validation\Rule;

class Update extends Component
{
    public $user;
    public $openModal = false;
    public $formId;

    public function mount($user)
    {
        $this->formId = $user->id;
    }

    public function render()
    {
        return view('livewire.users.update');
    }

    protected function rules()
    {
        return [
            'user.name' => ['required', 'min:2', 'string', 'max:50', 'regex:/^[a-zA-Z0-9\s]+$/'],
            'user.email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->user->id)],
            'user.userable.dob' => ['required', 'date'],
        ];
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function openModalToUpdateUser()
    {
        $this->resetErrorBag();
        $this->openModal = true;
    }

    public function update()
    {
        $this->user->update([
            'name' => $this->user->name,
            'email' => $this->user->email,
        ]);
        if ($this->user->userable) {
            $this->user->userable->update([
                'dob' => $this->user->userable->dob,
            ]);
        }

        $this->emit('updated', [
            'title'         => 'User updated successfully!',
            'icon'          => 'success',
            'iconColor'     => 'green',
        ]);

        $this->emit('saved');
        $this->reset();
        $this->openModal = false;
    }
}
