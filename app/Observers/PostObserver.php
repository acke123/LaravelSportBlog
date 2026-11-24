<?php

namespace App\Observers;

use App\Models\PostModel;
use Illuminate\Support\Facades\Cache;

class PostObserver
{
    /**
     * Handle the PostModel "created" event.
     */
    public function created(PostModel $postModel): void
    {
        Cache::forget('posts');
    }

    /**
     * Handle the PostModel "updated" event.
     */
    public function updated(PostModel $postModel): void
    {
        Cache::forget('posts');
    }

    /**
     * Handle the PostModel "deleted" event.
     */
    public function deleted(PostModel $postModel): void
    {
        Cache::forget('posts');
    }

    /**
     * Handle the PostModel "restored" event.
     */
    public function restored(PostModel $postModel): void
    {
        //
    }

    /**
     * Handle the PostModel "force deleted" event.
     */
    public function forceDeleted(PostModel $postModel): void
    {
        //
    }
}
