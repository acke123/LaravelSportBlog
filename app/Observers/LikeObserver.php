<?php

namespace App\Observers;

use App\Models\LikeModel;
use Illuminate\Support\Facades\Cache;

class LikeObserver
{
    /**
     * Handle the LikeModel "created" event.
     */
    public function created(LikeModel $likeModel): void
    {
        Cache::forget('posts');
    }

    /**
     * Handle the LikeModel "updated" event.
     */
    public function updated(LikeModel $likeModel): void
    {
        Cache::forget('posts');
    }

    /**
     * Handle the LikeModel "deleted" event.
     */
    public function deleted(LikeModel $likeModel): void
    {
        Cache::forget('posts');
    }

    /**
     * Handle the LikeModel "restored" event.
     */
    public function restored(LikeModel $likeModel): void
    {
        //
    }

    /**
     * Handle the LikeModel "force deleted" event.
     */
    public function forceDeleted(LikeModel $likeModel): void
    {
        //
    }
}
