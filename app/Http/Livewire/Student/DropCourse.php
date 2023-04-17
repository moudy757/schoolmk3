<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class DropCourse extends Component
{
    public $course;
    public $password;
    public $openModal = false;

    protected $rules = [
        'password' => ['required', 'current_password'],
    ];

    public function render()
    {
        return view('livewire.student.drop-course');
    }

    public function openModalToDropCourse()
    {
        $this->resetErrorBag();
        $this->openModal = true;
    }

    public function dropCourse()
    {
        $this->validate();

        $student = Auth::user()->userable;
        $student->courses()->detach($this->course->id);

        $this->emit('updated', [
            'title'         => 'Course dropped successfully!',
            'icon'          => 'success',
            'iconColor'     => 'green',
        ]);

        $this->emit('saved');
        $this->reset();
        $this->openModal = false;
    }
}
