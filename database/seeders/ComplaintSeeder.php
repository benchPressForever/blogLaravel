<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Reason;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Testing\Fakes\Fake;

class ComplaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            DB::table('complaints')->insert([
                'description' => fake()->realText(100),
                'user_id' => User::query()->inRandomOrder()->first()->id,
                'post_id' => Post::query()->inRandomOrder()->first()->id,
                'reason_id' => Reason::query()->inRandomOrder()->first()->id,
                'created_at' => now(),
            ]);
        }
    }
}
