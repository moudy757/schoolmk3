<?php

namespace App\Http\Livewire\News;

use Livewire\Component;
use Illuminate\Validation\Rule;

class Update extends Component
{
    public $newsArticle;
    public $openModal = false;
    public $formId;

    public function mount($newsArticle)
    {
        $this->formId = $newsArticle->id;
    }

    public function render()
    {
        return view('livewire.news.update');
    }

    protected function rules()
    {
        return [
            'newsArticle.name' => ['required', 'min:2', 'string', 'max:50', 'regex:/^[a-zA-Z0-9\s]+$/'],
            'newsArticle.body' => ['required', 'min:5', 'string', 'max:2000', 'regex:/^[a-zA-Z0-9\s_@.\/#&+-?!$]+$/'],
        ];
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function openModalToUpdateArticle()
    {
        $this->resetErrorBag();
        $this->openModal = true;
    }

    public function update()
    {
        $this->newsArticle->update([
            'name' => $this->newsArticle->name,
            'description' => $this->newsArticle->description,
            'level' => $this->newsArticle->level,
        ]);

        $this->emit('updated', [
            'title'         => 'Article updated successfully!',
            'icon'          => 'success',
            'iconColor'     => 'green',
        ]);

        $this->emit('saved');
        $this->reset();
        $this->openModal = false;
    }
}
