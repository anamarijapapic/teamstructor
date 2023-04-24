<?php

namespace App\Http\Livewire\Posts;

use App\Models\Post;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class ShowPost extends Component
{
    use InteractsWithBanner;

    public $post;

    public $postId;

    public $title;

    public $content;

    public $openEditModal;

    public $openDeleteModal;

    protected $listeners = ['postUpdated' => '$refresh'];

    protected $rules = [
        'title' => 'required',
        'content' => 'required',
    ];

    public function render()
    {
        return view('livewire.posts.show-post');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->postId = $id;
        $this->title = $post->title;
        $this->content = $post->content;

        $this->openEditModal = true;
    }

    public function update()
    {
        $this->validate();

        if ($this->postId) {
            Post::find($this->postId)->update([
                'title' => $this->title,
                'content' => $this->content,
            ]);

            $this->emitSelf('postUpdated');
            $this->banner('Post updated successfully.');

            $this->openEditModal = false;

            $this->reset(['title', 'content']);
        }
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);
        $this->postId = $id;

        $this->openDeleteModal = true;
    }

    public function destroy()
    {
        if ($this->postId) {
            Post::where('id', $this->postId)->delete();

            $this->emit('postDeleted');
            $this->banner('Post deleted successfully.');

            $this->openDeleteModal = false;
        }
    }
}
