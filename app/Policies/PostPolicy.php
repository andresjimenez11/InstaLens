<?php

namespace App\Policies;

use App\Models\User;
use App\Models\post;
use Illuminate\Auth\Access\Response;

class PostPolicy
{

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, post $post): bool
    {
        return $user->id === $post->user_id;
    }
}