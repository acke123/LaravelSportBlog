<?php

namespace App\Observers;

use App\Models\CommentModel;
use Illuminate\Support\Facades\Cache;

class CommentObserver
{
    /**
     * Handle the CommentModel "created" event.
     */
    public function created(CommentModel $commentModel): void
    {
        Cache::forget('posts');
    }

    /**
     * Handle the CommentModel "updated" event.
     */
    public function updated(CommentModel $commentModel): void
    {
        Cache::forget('posts');
    }

    /**
     * Handle the CommentModel "deleted" event.
     */
    public function deleted(CommentModel $commentModel): void
    {
        Cache::forget('posts');
    }

    /**
     * Handle the CommentModel "restored" event.
     */
    public function restored(CommentModel $commentModel): void
    {
        //
    }

    /**
     * Handle the CommentModel "force deleted" event.
     */
    public function forceDeleted(CommentModel $commentModel): void
    {
        //
    }
}
