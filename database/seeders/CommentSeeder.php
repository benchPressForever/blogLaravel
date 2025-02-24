<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 20; $i++) {
            DB::table('comments')->insert([
                'text' => fake()->realText(1000),
                'user_id' => User::query()->inRandomOrder()->first()->id,
                'post_id' => Post::query()->inRandomOrder()->first()->id,
                'created_at' => now(),
            ]);
        }
    }
}
