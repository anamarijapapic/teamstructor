<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::all();

        foreach ($posts as $post) {
            $users = $post->project->team->allUsers();

            foreach ($users as $user) {
                Comment::factory()->belongsToPost($post)->belongsToUser($user)->create();
            }
        }
    }
}
