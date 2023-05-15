<?php

namespace App\Http\Livewire\Media;

use App\Models\Resource;
use App\Models\User;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class ShowResource extends Component
{
    use InteractsWithBanner;

    public Resource $resource;

    public $author;

    public $resourceId;

    public $name;

    public $extension;

    public $openEditModal;

    public $openDeleteModal;

    protected $listeners = ['resourceUpdated' => '$refresh'];

    protected $rules = [
        'name' => 'required',
    ];

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
        return $this->resource;
    }

    public function edit($id)
    {
        $resource = Resource::findOrFail($id);

        // $this->authorize('update', $resource);

        $this->resourceId = $id;
        $this->name = $resource->name;
        $this->extension = $resource->extension;

        $this->openEditModal = true;
    }

    public function update()
    {
        $this->validate();

        if ($this->resourceId) {
            $resource = Resource::find($this->resourceId);

            $resource->name = $this->name;
            $resource->file_name = str_replace(['#', '/', '\\', ' '], '-', $this->name).'.'.$this->extension;
            $resource->save();

            $this->emitSelf('resourceUpdated');
            $this->banner('Resource updated successfully.');

            $this->openEditModal = false;

            $this->reset(['name', 'extension']);
        }
    }

    public function delete($id)
    {
        $resource = Resource::findOrFail($id);

        // $this->authorize('delete', $resource);

        $this->resourceId = $id;

        $this->openDeleteModal = true;
    }

    public function destroy()
    {
        if ($this->resourceId) {
            $project = Resource::find($this->resourceId)->model;

            $project->deleteMedia($this->resourceId);

            $this->emit('resourceDeleted');
            $this->banner('Resource deleted successfully.');

            $this->openDeleteModal = false;
        }
    }
}
