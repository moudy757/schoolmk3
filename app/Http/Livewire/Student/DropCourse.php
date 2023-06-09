<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class DropCourse extends Component
{
    public $course;
    public $student;
    public $password;
    public $openModal = false;

    protected $rules = [
        'password' => ['required', 'current_password'],
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.student.drop-course');
    }

    public function openModalToDropCourse()
    {
        $this->reset('password');
        $this->resetErrorBag();
        $this->openModal = true;
    }

    public function dropCourse()
    {
        $this->validate();

        if (Auth::user()->hasRole('student')) {
            $student = Auth::user()->userable;
            $student->courses()->detach($this->course->id);

            $this->emit('updated', [
                'title'         => 'Course dropped successfully!',
                'icon'          => 'success',
                'iconColor'     => 'green',
            ]);
            $this->dispatchBrowserEvent('refresh-page');
        } else {
            $this->course->students()->detach($this->student->id);
            $this->emit('updated', [
                'title'         => 'Student dropped successfully!',
                'icon'          => 'success',
                'iconColor'     => 'green',
            ]);
        }

        $this->emit('saved');
        $this->reset();
        $this->openModal = false;
    }
}
