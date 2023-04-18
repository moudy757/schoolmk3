<?php

namespace App\Http\Livewire\Teacher;

use App\Models\Course;
use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;

class EnrolledStudents extends Component
{
    use WithPagination;

    public $course;
    public $grade;

    public $perPage = 5;
    public $search = '';
    public $orderBy = 'id';
    public $orderAsc = true;

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
        return view('livewire.teacher.enrolled-students', [
            'students' => $this->course->students()
                ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                ->paginate($this->perPage),
        ]);
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function update($id)
    {
        // ddd($this->course);
        // dd(Student::findOrFail($id));
        $this->validate();

        $student = Student::findOrFail($id);
        $student->courses()->updateExistingPivot($this->course->id, [
            'grade' => $this->grade,
        ]);
        $this->emit('updated', [
            'title'         => 'Grade updated successfully!',
            'icon'          => 'success',
            'iconColor'     => 'green',
        ]);

        $this->emit('saved');
    }

    public function resetter()
    {
        $this->resetErrorBag();
    }
}
