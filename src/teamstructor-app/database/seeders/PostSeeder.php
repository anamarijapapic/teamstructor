<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Project;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = Project::all();

        foreach ($projects as $project) {
            $users = $project->team->allUsers();

            foreach ($users as $user) {
                Post::factory()->belongsToProject($project)->belongsToUser($user)->create();
            }
        }
    }
}
