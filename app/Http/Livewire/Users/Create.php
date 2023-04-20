<?php

namespace App\Http\Livewire\Users;

use App\Models\Student;
use App\Models\Teacher;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class Create extends Component
{
    public $user;

    public $role = 'teacher';

    public function render()
    {
        return view('livewire.users.create');
    }

    protected function rules()
    {
        return [
            'user.name' => ['required', 'min:2', 'string', 'max:50', 'regex:/^[a-zA-Z0-9\s]+$/'],
            'user.email' => ['required', 'email'],
            'user.dob' => ['required', 'date'],
            'user.level' => [Rule::requiredIf($this->role == 'student'), 'numeric', 'min:1', 'max:3'],
        ];
    }

    protected $validationAttributes = [
        'user.name' => 'Name',
        'user.email' => 'Email',
        'user.dob' => 'Date of Birth',
        'user.level' => 'Level',
    ];

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function create()
    {
        $this->validate();

        // dd($this->user);

        if ($this->role == 'teacher') {
            $user = Teacher::create([
                'dob' => $this->user['dob'],
            ]);
            $password = 'teacher';
            $role = 'teacher';
        } elseif ($this->role == 'student') {
            $user = Student::create([
                'level' => $this->user['level'],
                'dob' => $this->user['dob'],
            ]);
            $password = 'student';
            $role = 'student';
        }

        $user->user()->create([
            'name' => $this->user['name'],
            'email' => $this->user['email'],
            'password' => Hash::make($password),
        ])->assignRole($role);

        $this->emit('updated', [
            'title'         => 'User added successfully!',
            'icon'          => 'success',
            'iconColor'     => 'green',
        ]);

        $this->emit('saved');
        $this->reset();
    }
}
