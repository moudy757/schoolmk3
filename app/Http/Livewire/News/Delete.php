<?php

namespace App\Http\Livewire\News;

use Livewire\Component;

class Delete extends Component
{
    public $newsArticle;
    public $password;
    public $openModal = false;

    protected $rules = [
        'password' => ['required', 'current_password'],
    ];

    public function render()
    {
        return view('livewire.news.delete');
    }

    public function openModalToDeleteArticle()
    {
        $this->resetErrorBag();
        $this->openModal = true;
    }

    public function delete()
    {
        $this->validate();
        $this->newsArticle->delete();

        $this->emit('updated', [
            'title'         => 'Article deleted successfully!',
            'icon'          => 'success',
            'iconColor'     => 'green',
        ]);

        $this->emit('saved');
        $this->reset();
        $this->openModal = false;
    }
}
