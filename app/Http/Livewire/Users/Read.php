<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Read extends Component
{
    use WithPagination;

    public $perPage = 5;
    public $search = '';
    public $orderBy = 'name';
    public $orderAsc = true;

    public $role = 'teacher';

    protected $listeners = [
        'saved' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.users.read', [
            'users' => User::search($this->search)
                ->role($this->role)
                ->with('userable')
                ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                ->paginate($this->perPage),
        ]);
    }

    public function updating()
    {
        $this->resetPage();
    }
}
