<?php

namespace App\Http\Livewire\Courses;

use Livewire\Component;

class Delete extends Component
{
    public $course;
    public $password;
    public $openModal = false;

    protected $rules = [
        'password' => ['required', 'current_password'],
    ];

    public function render()
    {
        return view('livewire.courses.delete');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function openModalToDeleteCourse()
    {
        $this->reset('password');
        $this->resetErrorBag();
        $this->openModal = true;
    }

    public function delete()
    {
        $this->validate();
        if ($this->course->students->count() > 0) {
            $this->emit('updated', [
                'title'         => 'Course has students enrolled and cannot be deleted!',
                'icon'          => 'error',
                'iconColor'     => 'red',
            ]);
        } else {
            $this->course->delete();

            $this->emit('updated', [
                'title'         => 'Course deleted successfully!',
                'icon'          => 'success',
                'iconColor'     => 'green',
            ]);
        }

        $this->emit('saved');
        $this->reset();
        $this->openModal = false;
    }
}
