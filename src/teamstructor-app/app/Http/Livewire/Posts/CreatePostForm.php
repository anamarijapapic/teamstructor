<?php

namespace App\Http\Livewire\Posts;

use App\Models\Post;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class CreatePostForm extends Component
{
    use InteractsWithBanner;

    public $title;

    public $content;

    public Project $project;

    protected $rules = [
        'title' => 'required',
        'content' => 'required',
    ];

    public function render()
    {
        return view('livewire.posts.create-post-form');
    }

    public function store()
    {
        $this->validate();

        Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'project_id' => $this->project->id,
            'user_id' => Auth::user()->id,
        ]);

        $this->emit('postAdded');
        $this->banner(__('Post created successfully.'));

        $this->reset(['title', 'content']);
    }
}
