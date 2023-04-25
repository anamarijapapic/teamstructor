<?php

namespace App\Http\Livewire\Comments;

use App\Models\Post;
use Livewire\Component;

class ShowComments extends Component
{
    public Post $post;

    protected $listeners = [
        'commentAdded' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.comments.show-comments', [
            'comments' => $this->post->comments()->with(['user'])->get(),
        ]);
    }
}
