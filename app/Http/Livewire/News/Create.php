<?php

namespace App\Http\Livewire\News;

use App\Models\News;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $body;

    public $openModal = false;

    protected $listeners = [
        'openModalToCreateArticle',
    ];

    public function render()
    {
        return view('livewire.news.create');
    }

    protected function rules()
    {
        return [
            // 'name' => ['required', 'min:2', 'string', 'max:50', 'regex:/^[a-zA-Z0-9\s]+$/', Rule::unique('courses')->ignore($this->course->id)],
            'name' => ['required', 'min:2', 'string', 'max:50', 'regex:/^[a-zA-Z0-9\s]+$/'],
            'body' => ['required', 'min:5', 'string', 'max:1000', 'regex:/^[a-zA-Z0-9\s_@.\/#&+-?!$]+$/'],

        ];
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
        ]);

        $this->emit('updated', [
            'title'         => 'Article added successfully!',
            'icon'          => 'success',
            'iconColor'     => 'green',
        ]);

        $this->emit('saved');
        $this->reset();
        $this->openModal = false;
    }
}
