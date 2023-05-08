<?php

namespace App\Http\Livewire\Media;

use App\Models\Project;
use App\Models\Team;
use Livewire\Component;

class ShowResources extends Component
{
    public Team $team;

    public Project $project;

    protected $listeners = [
        'resourceAdded' => '$refresh',
        'resourceDeleted' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.media.show-resources', [
            'resources' => $this->project->getMedia(),
        ]);
    }
}
