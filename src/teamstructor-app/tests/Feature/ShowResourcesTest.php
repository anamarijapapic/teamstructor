<?php

use App\Http\Livewire\Media\ShowResource;
use App\Http\Livewire\Media\ShowResources;
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

    livewire(ShowResources::class, ['team' => $user->currentTeam, 'project' => $project])
        ->assertStatus(200);
});

test('show there is no resources', function () {
    actingAs($user = User::factory()->withPersonalTeam()->create());

    $project = Project::factory()->create([
        'team_id' => $user->currentTeam,
        'user_id' => $user,
    ]);

    expect($project->media)->toHaveCount(0);

    livewire(ShowResources::class, ['team' => $user->currentTeam, 'project' => $project])
        ->assertSee('There are no resources yet in this project.')
        ->assertDontSeeLivewire(ShowResource::class);
});

test('resources can be seen', function () {
    actingAs($user = User::factory()->withPersonalTeam()->create());

    $project = Project::factory()->create([
        'team_id' => $user->currentTeam,
        'user_id' => $user,
    ]);

    $resource = UploadedFile::fake()->image('test.png');

    $project
        ->addMedia($resource)
        ->withCustomProperties(['user_id' => $user->id])
        ->toMediaCollection('default', 's3');

    expect($project->media->count())->toBeGreaterThan(0);

    livewire(ShowResources::class, ['team' => $user->currentTeam, 'project' => $project])
        ->assertStatus(200)
        ->assertSeeLivewire(ShowResource::class);
});
