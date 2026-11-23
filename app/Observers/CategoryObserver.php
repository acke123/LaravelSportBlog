<?php

namespace App\Observers;

use App\Models\CategoryModel;
use Illuminate\Support\Facades\Cache;

class CategoryObserver
{
    /**
     * Handle the CategoryModel "created" event.
     */
    public function created(CategoryModel $categoryModel): void
    {
        Cache::forget('categories');
    }

    /**
     * Handle the CategoryModel "updated" event.
     */
    public function updated(CategoryModel $categoryModel): void
    {
        Cache::forget('categories');
    }

    /**
     * Handle the CategoryModel "deleted" event.
     */
    public function deleted(CategoryModel $categoryModel): void
    {
        Cache::forget('categories');
    }

    /**
     * Handle the CategoryModel "restored" event.
     */
    public function restored(CategoryModel $categoryModel): void
    {
        //
    }

    /**
     * Handle the CategoryModel "force deleted" event.
     */
    public function forceDeleted(CategoryModel $categoryModel): void
    {
        //
    }
}
