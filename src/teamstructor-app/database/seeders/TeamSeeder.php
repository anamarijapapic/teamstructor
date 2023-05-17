<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all()->except(1);

        foreach ($users as $user) {
            $otherUsers = $users->except($user->id)->random(4);

            foreach ($otherUsers as $member) {
                $user->personalTeam()->users()->attach(
                    $member
                );
            }
        }
    }
}
