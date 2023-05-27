<?php

namespace App\Http\Livewire\Courses;

use App\Models\Course;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $description;
    public $level;

    public $openModal = false;

    protected $listeners = [
        'openModalToCreateCourse',
    ];

    public function render()
    {
        return view('livewire.courses.create');
    }

    protected function rules()
    {
        return [
            // 'name' => ['required', 'min:2', 'string', 'max:50', 'regex:/^[a-zA-Z0-9\s]+$/', Rule::unique('courses')->ignore($this->course->id)],
            'name' => ['required', 'min:2', 'string', 'max:50', 'regex:/^[a-zA-Z0-9\s]+$/', 'unique:courses,name'],
            'description' => ['required', 'min:5', 'string', 'max:1000', 'regex:/^[a-zA-Z0-9\s_@.\/#&+-?!$]+$/'],
            'level' => ['required', 'numeric', 'min:1', 'max:3'],
        ];
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function openModalToCreateCourse()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->openModal = true;
    }

    public function create()
    {
        $this->validate();

        if (auth()->user()->userable->courses->count() < 5) {
            Course::create([
                'name' => $this->name,
                'description' => $this->description,
                'level' => $this->level,
                'teacher_id' => auth()->user()->userable->id,
            ]);

            $this->emit('updated', [
                'title'         => 'Course added successfully!',
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
        $this->reset();
        $this->openModal = false;
    }
}
