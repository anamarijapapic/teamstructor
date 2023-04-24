<?php

namespace App\Http\Livewire\Posts;

use App\Models\Project;
use App\Models\Team;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;
use Livewire\WithPagination;

class ShowPosts extends Component
{
    use WithPagination;
    use InteractsWithBanner;

    public Team $team;

    public Project $project;

    public $perPage = 5;

    protected $listeners = [
        'postAdded' => '$refresh',
        'postDeleted' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.posts.show-posts', [
            'posts' => $this->project->posts()->paginate($this->perPage),
        ]);
    }
}
