<?php

namespace App\Http\Livewire\Media;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadResource extends Component
{
    use InteractsWithBanner;
    use WithFileUploads;

    public Project $project;

    public $resource;

    public function render()
    {
        return view('livewire.media.upload-resource');
    }

    public function save()
    {
        $this->validate([
            'resource' => 'required|file|max:12288', // (12MB max)
        ]);

        $this->project
            ->addMedia($this->resource)
            ->withCustomProperties(['user_id' => Auth::user()->id])
            ->toMediaCollection('default', 's3');

        $this->emit('resourceAdded');
        $this->banner(__('Resource uploaded successfully.'));

        $this->reset(['resource']);
    }
}
