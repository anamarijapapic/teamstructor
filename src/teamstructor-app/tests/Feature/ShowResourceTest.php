<?php

use App\Http\Livewire\Media\ShowResource;
use App\Models\Project;
use App\Models\Resource;
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

    $uploadedFile = UploadedFile::fake()->image('test.png');

    $project
        ->addMedia($uploadedFile)
        ->withCustomProperties(['user_id' => $user->id])
        ->toMediaCollection('default', 's3');

    $resource = $project->getFirstMedia();

    livewire(ShowResource::class, ['resource' => $resource])
        ->assertStatus(200);
});

test('resource can be updated', function () {
    actingAs($user = User::factory()->withPersonalTeam()->create());

    $project = Project::factory()->create([
        'team_id' => $user->currentTeam,
        'user_id' => $user,
    ]);

    $uploadedFile = UploadedFile::fake()->image('test.png');

    $project
        ->addMedia($uploadedFile)
        ->withCustomProperties(['user_id' => $user->id])
        ->toMediaCollection('default', 's3');

    $this->assertTrue(Resource::where('name', 'test')->exists());

    $resource = $project->getFirstMedia();

    livewire(ShowResource::class, ['resource' => $resource])
        ->call('edit', $resource->id)
        ->assertSet('resourceId', $resource->id)
        ->assertSet('openEditModal', true)
        ->set([
            'name' => 'updated',
        ])
        ->call('update')
        ->assertEmitted('resourceUpdated')
        ->assertSet('openEditModal', false);

    $this->assertTrue(Resource::where('name', 'test')->doesntExist());
    $this->assertTrue(Resource::where('name', 'updated')->exists());
});

test('resource cant be updated if action is unauthorized', function () {
    actingAs($user = User::factory()->withPersonalTeam()->create());

    $project = Project::factory()->create([
        'team_id' => $user->currentTeam,
        'user_id' => $user,
    ]);

    $uploadedFile = UploadedFile::fake()->image('test.png');

    $project
        ->addMedia($uploadedFile)
        ->withCustomProperties(['user_id' => $user->id])
        ->toMediaCollection('default', 's3');

    $this->assertTrue(Resource::where('name', 'test')->exists());

    $resource = $project->getFirstMedia();

    $user->currentTeam->users()->attach(
        $otherUser = User::factory()->withPersonalTeam()->create(), ['role' => 'admin']
    );

    actingAs($otherUser);

    livewire(ShowResource::class, ['resource' => $resource])
        ->call('edit', $resource->id)
        ->assertForbidden();
});

test('resource can be deleted', function () {
    actingAs($user = User::factory()->withPersonalTeam()->create());

    $project = Project::factory()->create([
        'team_id' => $user->currentTeam,
        'user_id' => $user,
    ]);

    $uploadedFile = UploadedFile::fake()->image('test.png');

    $project
        ->addMedia($uploadedFile)
        ->withCustomProperties(['user_id' => $user->id])
        ->toMediaCollection('default', 's3');

    $this->assertTrue(Resource::where('name', 'test')->exists());

    $resource = $project->getFirstMedia();

    livewire(ShowResource::class, ['resource' => $resource])
        ->call('delete', $resource->id)
        ->assertSet('resourceId', $resource->id)
        ->assertSet('openDeleteModal', true)
        ->call('destroy')
        ->assertEmitted('resourceDeleted')
        ->assertSet('openDeleteModal', false);

    $this->assertTrue(Resource::where('name', 'test')->doesntExist());
});

test('resource cant be deleted if action is unauthorized', function () {
    actingAs($user = User::factory()->withPersonalTeam()->create());

    $project = Project::factory()->create([
        'team_id' => $user->currentTeam,
        'user_id' => $user,
    ]);

    $uploadedFile = UploadedFile::fake()->image('test.png');

    $project
        ->addMedia($uploadedFile)
        ->withCustomProperties(['user_id' => $user->id])
        ->toMediaCollection('default', 's3');

    $this->assertTrue(Resource::where('name', 'test')->exists());

    $resource = $project->getFirstMedia();

    $user->currentTeam->users()->attach(
        $otherUser = User::factory()->withPersonalTeam()->create(), ['role' => 'admin']
    );

    actingAs($otherUser);

    livewire(ShowResource::class, ['resource' => $resource])
        ->call('delete', $resource->id)
        ->assertForbidden();
});
