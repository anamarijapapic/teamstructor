<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Team;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = Team::all()->except(1);

        foreach ($teams as $team) {
            $users = $team->allUsers();

            foreach ($users as $user) {
                Project::factory()->belongsToTeam($team)->belongsToUser($user)->create();
            }
        }
    }
}
