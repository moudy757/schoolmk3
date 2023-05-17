<?php

namespace App\Http\Livewire\Student;

use App\Models\Course;
use Livewire\Component;

class ViewGrades extends Component
{
    public function render()
    {
        return view('livewire.student.view-grades', [
            'courses' => $this->getCourses(),
        ]);
    }

    public function getCourses()
    {
        // return Course::whereRelation('students', 'student_id', auth()->user()->userable->id);
        // ddd(auth()->user()->userable->courses);
        return auth()->user()->userable->courses;
    }
}
