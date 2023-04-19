<?php

namespace App\Http\Livewire\Projects;

use App\Models\Project;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class Projects extends Component
{
    use InteractsWithBanner;

    public $projects;

    public $project_id;

    public $name;

    public $description;

    public $team;

    public $team_id;

    public $user_id;

    public $creatingOrEditingProject = false;

    public $confirmingProjectDeletion = false;

    public $projectIdBeingDeleted;

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
    ];

    public function mount($team)
    {
        $this->team_id = $team;
    }

    public function render()
    {
        $this->team = Team::findOrFail($this->team_id);

        $this->projects = $this->team->projects;

        return view('livewire.projects.projects');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->creatingOrEditingProject = true;
    }

    public function store()
    {
        $this->validate();

        Project::updateOrCreate(
            ['id' => $this->project_id],
            [
                'name' => $this->name,
                'description' => $this->description,
                'team_id' => $this->team_id,
                'user_id' => Auth::user()->id,
            ]
        );

        $this->banner($this->project_id ? 'Project updated successfully.' : 'Project created successfully.');

        $this->creatingOrEditingProject = false;
        $this->resetInputFields();
    }

    public function edit($projectId)
    {
        $project = Project::findOrFail($projectId);
        $this->project_id = $projectId;
        $this->name = $project->name;
        $this->description = $project->description;

        $this->creatingOrEditingProject = true;
    }

    public function delete()
    {
        $project = Project::where('id', $this->projectIdBeingDeleted)->delete();

        $this->banner('Project deleted successfully.');

        $this->confirmingProjectDeletion = false;
    }

    public function confirmDeletion($projectId)
    {
        $this->confirmingProjectDeletion = true;

        $this->projectIdBeingDeleted = $projectId;
    }

    private function resetInputFields()
    {
        $this->project_id = '';
        $this->name = '';
        $this->description = '';
    }
}
