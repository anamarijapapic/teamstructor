<?php

use App\Http\Livewire\Media\UploadResource;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use function Pest\Laravel\{actingAs};
use function Pest\Livewire\livewire;

uses()->group('feature', 'resources');

uses(RefreshDatabase::class);

test('the component can render', function () {
    actingAs($user = User::factory()->withPersonalTeam()->create());

    $project = Project::factory()->create([
        'team_id' => $user->currentTeam,
        'user_id' => $user,
    ]);

    livewire(UploadResource::class, ['project' => $project])
        ->assertStatus(200);
});

test('resources can be created', function () {
    actingAs($user = User::factory()->withPersonalTeam()->create());

    $project = Project::factory()->create([
        'team_id' => $user->currentTeam,
        'user_id' => $user,
    ]);

    $resource = UploadedFile::fake()->image('test.png');

    livewire(UploadResource::class, ['project' => $project])
        ->set([
            'resource' => $resource,
        ])
        ->call('save')
        ->assertEmitted('resourceAdded');
});

test('valid input must be provided before resource can be created', function () {
    actingAs($user = User::factory()->withPersonalTeam()->create());

    $project = Project::factory()->create([
        'team_id' => $user->currentTeam,
        'user_id' => $user,
    ]);

    livewire(UploadResource::class, ['project' => $project])
        ->set([
            'resource' => '',
        ])
        ->call('save')
        ->assertHasErrors('resource');
});
