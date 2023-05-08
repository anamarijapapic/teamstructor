<?php

namespace App\Http\Livewire\Projects;

use App\Models\Project;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class ShowProject extends Component
{
    use AuthorizesRequests;
    use InteractsWithBanner;

    public Project $project;

    public $projectId;

    public $name;

    public $description;

    public $openEditModal = false;

    public $openDeleteModal = false;

    protected $listeners = ['projectUpdated' => '$refresh'];

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
    ];

    public function render()
    {
        return view('livewire.projects.show-project');
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);

        $this->authorize('update', $project);

        $this->projectId = $id;
        $this->name = $project->name;
        $this->description = $project->description;

        $this->openEditModal = true;
    }

    public function update()
    {
        $this->validate();

        if ($this->projectId) {
            Project::find($this->projectId)->update([
                'name' => $this->name,
                'description' => $this->description,
            ]);

            $this->emitSelf('projectUpdated');
            $this->banner('Project updated successfully.');

            $this->openEditModal = false;

            $this->reset(['name', 'description']);
        }
    }

    public function delete($id)
    {
        $project = Project::findOrFail($id);

        $this->authorize('delete', $project);

        $this->projectId = $id;

        $this->openDeleteModal = true;
    }

    public function destroy()
    {
        if ($this->projectId) {
            Project::where('id', $this->projectId)->delete();

            $this->emit('projectDeleted');
            $this->banner('Project deleted successfully.');

            $this->openDeleteModal = false;
        }
    }
}
