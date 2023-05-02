<?php

namespace App\Http\Livewire\Projects;

use App\Models\Project;
use App\Models\Team;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class Projects extends Component
{
    use AuthorizesRequests;
    use InteractsWithBanner;

    public $projects;

    public $projectId;

    public $name;

    public $description;

    public Team $team;

    public $creatingOrEditingProject = false;

    public $confirmingProjectDeletion = false;

    public $projectIdBeingDeleted;

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
    ];

    public function render()
    {
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
            ['id' => $this->projectId],
            [
                'name' => $this->name,
                'description' => $this->description,
                'team_id' => $this->team->id,
                'user_id' => Auth::user()->id,
            ]
        );

        $this->banner($this->projectId ? 'Project updated successfully.' : 'Project created successfully.');

        $this->creatingOrEditingProject = false;
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);

        $this->authorize('update', $project);

        $this->projectId = $id;
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

    public function confirmDeletion($id)
    {
        $project = Project::findOrFail($id);

        $this->authorize('delete', $project);

        $this->confirmingProjectDeletion = true;

        $this->projectIdBeingDeleted = $id;
    }

    private function resetInputFields()
    {
        $this->projectId = '';
        $this->name = '';
        $this->description = '';
    }
}
