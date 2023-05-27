<?php

namespace App\Http\Livewire\News;

use App\Models\News;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class Read extends Component
{
    use WithPagination;

    protected $listeners = [
        'saved' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.news.read', [
            'news' => $this->getNews(),
        ]);
    }

    public function getNews()
    {
        if (auth()->user()->hasAnyRole('super-admin', 'admin')) {
            return News::where('for_whom', 'all')
                ->orWhere('for_whom', 'admins')
                ->latest()->paginate(5);
        } elseif (auth()->user()->hasRole('teacher')) {
            return News::where('for_whom', 'all')
                ->orWhere('for_whom', 'teachers')
                ->latest()->paginate(5);
        } elseif (auth()->user()->hasRole('student')) {
            return News::where('for_whom', 'all')
                ->orWhere(
                    function (Builder $query) {
                        $courses = auth()->user()->userable->courses;
                        foreach ($courses as $course) {
                            $query->orWhere('course_id', $course->id);
                        }
                    }
                )
                ->with('course')
                ->latest()->paginate(5);
        }
    }
}
