<?php

use App\Http\Livewire\Media\ShowResources;
use App\Http\Livewire\Posts\ShowPosts;
use App\Http\Livewire\Projects\ShowProjects;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('teams/{team}/projects', ShowProjects::class)
        ->name('teams.projects');

    Route::get('teams/{team}/projects/{project}/discussion', ShowPosts::class)
        ->name('teams.projects.discussion');

    Route::get('teams/{team}/projects/{project}/resources', ShowResources::class)
        ->name('teams.projects.resources');
});

Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth:sanctum', 'can:admin-privileges'],
], function () {
    Route::get('/', function () {
        return view('admin-dashboard');
    })->name('admin.dashboard');
});
