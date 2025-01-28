<?php

namespace App\Models;

class Posts
{
    public function getPosts(): array
    {
        return [
           1 => [
                'id' => 1,
                'slug' => 'firt_post_2025_21_12',
                'title' => 'First post',
                'text' => 'This is post 1',
            ],
            [
                'id' => 2,
                'title' => 'First post2',
                'text' => 'This is post 2',
            ],

        ];
    }


    public function getPost(int $id): array
    {
        return [];
    }
}
