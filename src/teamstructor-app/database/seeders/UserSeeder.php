<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usersCount = max((int) $this->command->ask('How many users would you like?', 20), 1);

        User::factory()->administrator()->withPersonalTeam()->create();

        User::factory()->anamarijaPapic()->withPersonalTeam()->create();

        User::factory($usersCount)->withPersonalTeam()->create();
    }
}
