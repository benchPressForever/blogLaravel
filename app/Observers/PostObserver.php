<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Log;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        Log::channel('app')->info('Post created', ['post' => $post]);
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        Log::channel('app')->info('Post updated', ['post' => $post]);
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        Log::channel('app')->info('Post deleted', ['post' => $post]);
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        Log::channel('app')->info('Post restored', ['post' => $post]);
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        Log::channel('app')->info('Post forceDeleted', ['post' => $post]);
    }
}
