<?php

namespace App\Http\Livewire\News;

use App\Models\News;
use Livewire\Component;
use Livewire\WithPagination;

class Read extends Component
{
    use WithPagination;

    protected $listeners = [
        'saved' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.news.read', [
            'news' => News::latest()->paginate(5),
        ]);
    }
}
