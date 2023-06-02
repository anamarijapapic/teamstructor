<?php

namespace App\Http\Livewire\Admin;

use App\Models\Team;
use Livewire\Component;
use Livewire\WithPagination;

class ShowTeams extends Component
{
    use WithPagination;

    public $search = '';

    public $page = 1;

    public $perPage = 5;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function render()
    {
        $teams = $this->queryString
            ? Team::where('name', 'like', '%'.$this->search.'%')
            : Team::all();

        return view('livewire.admin.show-teams', ['teams' => $teams->paginate($this->perPage)]);
    }
}
