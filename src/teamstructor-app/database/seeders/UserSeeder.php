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
        User::factory()->administrator()->withPersonalTeam()->create();

        User::factory()->anamarijaPapic()->withPersonalTeam()->create();

        User::factory(20)->withPersonalTeam()->create();
    }
}
