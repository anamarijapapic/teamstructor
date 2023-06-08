<?php

namespace App\Http\Livewire\Comments;

use App\Models\Comment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class ShowComment extends Component
{
    use AuthorizesRequests;
    use InteractsWithBanner;

    public Comment $comment;

    public $commentId;

    public $content;

    public $openEditModal;

    public $openDeleteModal;

    protected $listeners = ['commentUpdated' => '$refresh'];

    protected $rules = [
        'content' => 'required',
    ];

    public function render()
    {
        return view('livewire.comments.show-comment');
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);

        $this->authorize('update', $comment);

        $this->commentId = $id;
        $this->content = $comment->content;

        $this->openEditModal = true;
    }

    public function update()
    {
        $this->validate();

        if ($this->commentId) {
            Comment::find($this->commentId)->update([
                'content' => $this->content,
            ]);

            $this->emitSelf('commentUpdated');
            $this->banner(__('Comment updated successfully.'));

            $this->openEditModal = false;

            $this->reset(['content']);
        }
    }

    public function delete($id)
    {
        $comment = Comment::findOrFail($id);

        $this->authorize('delete', $comment);

        $this->commentId = $id;

        $this->openDeleteModal = true;
    }

    public function destroy()
    {
        if ($this->commentId) {
            Comment::where('id', $this->commentId)->delete();

            $this->emit('commentDeleted');
            $this->banner(__('Comment deleted successfully.'));

            $this->openDeleteModal = false;
        }
    }
}
