<?php

namespace App\Http\Livewire\Teacher;

use App\Models\Course;
use App\Models\Student;
use Livewire\Component;

class EnrolledStudents extends Component
{
    public $course;
    public $grade;

    public $openModal = false;

    protected $listeners = [
        'openModalToViewStudents',
    ];

    protected $rules = [
        'grade' => ['required', 'numeric', 'min:1', 'max:100']
    ];

    public function openModalToViewStudents()
    {
        // dd($this->course);
        $this->resetErrorBag();
        $this->openModal = true;
    }

    public function render()
    {
        return view('livewire.teacher.enrolled-students');
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function update($id)
    {
        // dd(Student::findOrFail($id));
        $student = Student::findOrFail($id);
        $student->courses()->updateExistingPivot($this->course->id, [
            'grade' => $this->grade,
        ]);
        $this->emit('updated', [
            'title'         => 'Course updated successfully!',
            'icon'          => 'success',
            'iconColor'     => 'green',
        ]);

        $this->emit('saved');
    }

    // public function editGradeInput($student)
    // {
    //     $this->student = $student;
    // }
}
