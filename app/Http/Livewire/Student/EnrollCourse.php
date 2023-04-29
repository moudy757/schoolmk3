<?php

namespace App\Http\Livewire\Student;

use App\Models\Course;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EnrollCourse extends Component
{
    public $course;

    public function render()
    {
        return view('livewire.student.enroll-course');
    }

    public function enrollCourse()
    {
        $student = Auth::user()->userable;

        $exists = DB::table('course_student')
            ->whereStudentId($student->id)
            ->whereCourseId($this->course->id)
            ->count() > 0;

        if ($exists) {
            $this->emit('updated', [
                'title'         => 'Course already enrolled.',
                'icon'          => 'error',
                'iconColor'     => 'red',
            ]);
            // $this->exists = $exists;
        } elseif ($student->courses()->count() < 5) {
            $student->courses()->syncWithoutDetaching([$this->course->id, ['student_name' => Auth::user()->name]]);

            $this->emit('updated', [
                'title'         => 'Course enrolled successfully.',
                'icon'          => 'success',
                'iconColor'     => 'green',
            ]);
        } else {
            $this->emit('updated', [
                'title'         => 'Number of allowed courses reached.',
                'icon'          => 'error',
                'iconColor'     => 'red',
            ]);
        }

        $this->emit('saved');
    }
}
