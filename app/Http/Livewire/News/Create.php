<?php

namespace App\Http\Livewire\News;

use App\Models\Course;
use App\Models\News;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;

class Create extends Component
{
    use WithPagination;

    public $name;
    public $body;
    public $forWhom;
    public $courseId = null;

    // public $courses = [];

    public $openModal = false;

    protected $listeners = [
        'openModalToCreateArticle',
    ];

    public function render()
    {
        return view('livewire.news.create', [
            'courses' => $this->getCourses()
        ]);
    }

    protected function rules()
    {
        return [
            // 'name' => ['required', 'min:2', 'string', 'max:50', 'regex:/^[a-zA-Z0-9\s]+$/', Rule::unique('courses')->ignore($this->course->id)],
            'name' => ['required', 'min:2', 'string', 'max:50', 'regex:/^[a-zA-Z0-9\s_@.()\/#&+-?!$]+$/'],
            'body' => ['required', 'min:5', 'string', 'max:1000', 'regex:/^[a-zA-Z0-9\s_@.()\/#&+-?!$]+$/'],
            'forWhom' => ['required', 'min:2', 'string', 'max:20', 'regex:/^[a-zA-Z]+$/'],
            'courseId' => [Rule::requiredIf($this->forWhom == 'students')],
        ];
    }

    protected $validationAttributes = [
        'courseId' => 'Course',
        'forWhom' => 'For',
    ];

    public function getCourses()
    {
        if (auth()->user()->hasRole('teacher')) {
            return auth()->user()->userable->courses;
        } elseif (auth()->user()->hasRole('super-admin')) {
            return Course::orderBy('name', 'asc')->limit(500)
                ->without('students')
                ->get(['id', 'name']);
        }
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function openModalToCreateArticle()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->openModal = true;
    }

    public function create()
    {
        $this->validate();

        News::create([
            'name' => $this->name,
            'body' => $this->body,
            'for_whom' => $this->forWhom,
            'user_id' => auth()->id(),
            'course_id' => $this->courseId,
        ]);

        $this->emit('updated', [
            'title'         => 'Article added successfully!',
            'icon'          => 'success',
            'iconColor'     => 'green',
        ]);

        $this->emit('saved');
        $this->reset();
        $this->openModal = false;
        $this->resetPage();
    }
}
