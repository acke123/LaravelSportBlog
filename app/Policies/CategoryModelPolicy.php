<?php

namespace App\Policies;

use App\Models\CategoryModel;
use App\Models\User;

class CategoryModelPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CategoryModel $categoryModel): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CategoryModel $categoryModel): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CategoryModel $categoryModel): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CategoryModel $categoryModel): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CategoryModel $categoryModel): bool
    {
        return false;
    }

    public function updateCategory(User $user): bool
    {
        return $user->role == User::ADMIN;
    }
}
