<?php

namespace App\Http\Livewire\Media;

use App\Models\User;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ShowResource extends Component
{
    public Media $resource;

    public $author;

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
}
