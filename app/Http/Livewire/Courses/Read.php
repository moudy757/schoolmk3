<?php

namespace App\Http\Livewire\Courses;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class Read extends Component
{
    use WithPagination;

    public $perPage = 5;
    public $search = '';
    public $orderBy = 'name';
    public $orderAsc = true;

    public $enrolled = true;

    protected $listeners = [
        'saved' => '$refresh',
    ];

    public function render()
    {
        if (auth()->user()->hasRole('teacher')) {
            return view('livewire.courses.read', [
                'courses' => Course::search($this->search)
                    ->where('teacher_id', auth()->user()->userable->id)
                    ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage),
            ]);
        } elseif (auth()->user()->hasRole('student')) {
            return view('livewire.courses.read', [
                'courses' => Course::search($this->search)
                    ->where('level', auth()->user()->userable->level)
                    ->when(
                        $this->enrolled,
                        function ($query) {
                            return $query->whereRelation('students', 'student_id', auth()->user()->userable->id);
                        },
                        function ($query) {
                            return $query->whereDoesntHave('students', function ($query) {
                                $query->where('student_id', auth()->user()->userable->id);
                            });
                        }
                    )
                    ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage),
            ]);
        }
    }

    public function updating()
    {
        $this->resetPage();
    }
}
