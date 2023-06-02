<?php

namespace App\Http\Livewire\Admin;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class ShowProjects extends Component
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
        $projects = $this->queryString
        ? Project::where('name', 'like', '%'.$this->search.'%')
        : Project::all();

        return view('livewire.admin.show-projects', ['projects' => $projects->paginate($this->perPage)]);
    }
}
