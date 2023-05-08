<?php

namespace App\Http\Livewire\Media;

use App\Models\User;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ShowResource extends Component
{
    use InteractsWithBanner;

    public Media $resource;

    public $author;

    public $resourceId;

    public $openDeleteModal;

    public function mount()
    {
        $this->author = User::find($this->resource->getCustomProperty('user_id'));
    }

    public function render()
    {
        return view('livewire.media.show-resource');
    }

    public function download()
    {
        return response()->download($this->resource->getPath(), $this->resource->file_name);
    }

    public function delete($id)
    {
        $resource = Media::findOrFail($id);

        // $this->authorize('delete', $resource);

        $this->resourceId = $id;

        $this->openDeleteModal = true;
    }

    public function destroy()
    {
        if ($this->resourceId) {
            Media::where('id', $this->resourceId)->delete();

            $this->emit('resourceDeleted');
            $this->banner('Resource deleted successfully.');

            $this->openDeleteModal = false;
        }
    }
}
