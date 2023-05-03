<?php

use App\Http\Livewire\Posts\ShowPosts;
use App\Http\Livewire\Projects\Projects;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/teams/{team}/projects/{project}/discussion', ShowPosts::class)->name('teams.projects.discussion');
    Route::get('/teams/{team}/projects', Projects::class)->name('teams.projects');
});
