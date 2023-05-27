<?php

namespace App\Http\Livewire\Users;

use App\Mail\UserAdded;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
            'user.email' => ['required', 'email', 'unique:users,email'],
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
            $login_id = 'tc';
        } elseif ($this->role == 'student') {
            $user = Student::create([
                'level' => $this->user['level'],
                'dob' => $this->user['dob'],
            ]);
            $password = 'student';
            $role = 'student';
            $login_id = 'st';
        } elseif ($this->role == 'admin' && Gate::allows('admins.create')) {
            $createdUser = User::create([
                'name' => $this->user['name'],
                'email' => $this->user['email'],
                'login_id' => $this->user['email'],
                'password' => Hash::make('admin'),
            ])->assignRole('admin');
            $password = 'admin';
            $role = 'admin';
            $login_id = $this->user['email'];
        } else {
            abort(403);
        }

        if ($this->role == 'teacher' || $this->role == 'student') {
            $createdUser = $user->user()->create([
                'name' => $this->user['name'],
                'email' => $this->user['email'],
                'login_id' => $login_id . date("Y") . str_pad($user->id, 3, '0', STR_PAD_LEFT),
                'password' => Hash::make($password),
            ])->assignRole($role);
        }

        $userData = [
            'id' => $createdUser->login_id,
            'name' => $createdUser->name,
            'pass' => $password,
        ];

        $this->emit('created', [
            'title'         => 'User added successfully!' . '<br/>' . $role . ' ID: ' . $createdUser->login_id . '<br/> Password: ' . $password,
            'icon'          => 'success',
            'iconColor'     => 'green',
        ]);

        // Mail::to($createdUser)->send(new UserAdded($userData));

        $this->emit('saved');
        $this->reset();
    }
}
