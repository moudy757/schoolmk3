<?php

namespace App\Http\Livewire\Courses;

use Livewire\Component;
use Illuminate\Validation\Rule;

class Update extends Component
{
    public $course;
    public $openModal = false;
    public $formId;

    public function mount($course)
    {
        $this->formId = $course->id;
    }

    public function render()
    {
        return view('livewire.courses.update');
    }

    protected function rules()
    {
        return [
            'course.name' => ['required', 'min:2', 'string', 'max:50', 'regex:/^[a-zA-Z0-9\s]+$/', Rule::unique('courses', 'name')->ignore($this->course->id)],
            // 'course.name' => ['required', 'min:2', 'string', 'max:50', 'regex:/^[a-zA-Z0-9\s]+$/', 'unique:courses,name'],
            'course.description' => ['required', 'min:5', 'string', 'max:1000', 'regex:/^[a-zA-Z0-9\s_@.\/#&+-?!$]+$/'],
            'course.level' => ['required', 'numeric', 'min:1', 'max:3'],
        ];
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function openModalToUpdateCourse()
    {
        $this->resetErrorBag();
        $this->openModal = true;
    }

    public function update()
    {
        $this->course->update([
            'name' => $this->course->name,
            'description' => $this->course->description,
            'level' => $this->course->level,
        ]);

        $this->emit('updated', [
            'title'         => 'Course updated successfully!',
            'icon'          => 'success',
            'iconColor'     => 'green',
        ]);

        $this->emit('saved');
        $this->reset();
        $this->openModal = false;
    }
}
