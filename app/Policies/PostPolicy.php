<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('manage posts');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Post $post): bool
    {
        return $user->hasPermissionTo('manage posts');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('manage posts') || $user->hasPermissionTo('create own posts');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post): bool
    {
        if ($user->hasRole('Admin') || $user->hasRole('Editor')) {
            return true;
        }

        if ($user->hasPermissionTo('edit own posts')) {
            return $user->id === $post->created_by;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        if ($user->hasRole('Admin') || $user->hasRole('Editor')) {
            return true;
        }

        if ($user->hasPermissionTo('edit own posts')) {
            return $user->id === $post->created_by;
        }

        return false;
    }
}
