<?php

namespace App\Http\Livewire\Posts;

use App\Models\Post;
use App\Models\Project;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class Posts extends Component
{
    use InteractsWithBanner;

    public $posts;

    public $post_id;

    public $title;

    public $content;

    public $user_id;

    public $team;

    public $team_id;

    public $project;

    public $project_id;

    public $creatingOrEditingPost = false;

    public $confirmingPostDeletion = false;

    public $postIdBeingDeleted;

    protected $rules = [
        'title' => 'required',
        'content' => 'required',
    ];

    public function mount($team, $project)
    {
        $this->team_id = $team;
        $this->project_id = $project;
    }

    public function render()
    {
        $this->team = Team::findOrFail($this->team_id);
        $this->project = Project::findOrFail($this->project_id);

        $this->posts = $this->project->posts;

        return view('livewire.posts.posts');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->creatingOrEditingPost = true;
    }

    public function store()
    {
        $this->validate();

        Post::updateOrCreate(
            ['id' => $this->post_id],
            [
                'title' => $this->title,
                'content' => $this->content,
                'project_id' => $this->project_id,
                'user_id' => Auth::user()->id,
            ]
        );

        $this->banner($this->post_id ? 'Post updated successfully.' : 'Post created successfully.');

        $this->creatingOrEditingPost = false;
        $this->resetInputFields();
    }

    public function edit($postId)
    {
        $post = Post::findOrFail($postId);
        $this->post_id = $postId;
        $this->title = $post->title;
        $this->content = $post->content;

        $this->creatingOrEditingPost = true;
    }

    public function delete()
    {
        $project = Post::where('id', $this->postIdBeingDeleted)->delete();

        $this->banner('Post deleted successfully.');

        $this->confirmingPostDeletion = false;
    }

    public function confirmDeletion($postId)
    {
        $this->confirmingPostDeletion = true;

        $this->postIdBeingDeleted = $postId;
    }

    private function resetInputFields()
    {
        $this->post_id = '';
        $this->title = '';
        $this->content = '';
    }
}
