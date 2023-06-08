<?php

namespace App\Http\Livewire\Projects;

use App\Models\Project;
use App\Models\Team;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class ShowProjects extends Component
{
    use AuthorizesRequests;
    use InteractsWithBanner;

    public $name;

    public $description;

    public Team $team;

    public $openCreateModal = false;

    protected $listeners = [
        'projectAdded' => '$refresh',
        'projectDeleted' => '$refresh',
    ];

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
    ];

    public function render()
    {
        return view('livewire.projects.show-projects', ['projects' => $this->team->projects]);
    }

    public function create()
    {
        $this->openCreateModal = true;
    }

    public function store()
    {
        $this->validate();

        Project::create([
            'name' => $this->name,
            'description' => $this->description,
            'team_id' => $this->team->id,
            'user_id' => Auth::user()->id,
        ]);

        $this->openCreateModal = false;

        $this->emitSelf('projectAdded');
        $this->banner(__('Project created successfully.'));

        $this->reset(['name', 'description']);
    }
}
