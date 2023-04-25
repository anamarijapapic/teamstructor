<?php

namespace App\Http\Livewire\Comments;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\InteractsWithBanner;

class CreateCommentForm extends Component
{
    use InteractsWithBanner;

    public $content;

    public Post $post;

    protected $rules = [
        'content' => 'required',
    ];

    public function render()
    {
        return view('livewire.comments.create-comment-form');
    }

    public function store()
    {
        $this->validate();

        Comment::create([
            'content' => $this->content,
            'post_id' => $this->post->id,
            'user_id' => Auth::user()->id,
        ]);

        $this->emitUp('commentAdded');
        $this->banner('Comment created successfully.');

        $this->reset(['content']);
    }
}
