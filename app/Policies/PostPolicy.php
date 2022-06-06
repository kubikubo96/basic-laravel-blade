<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function updatePost(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

    public function deletePost(User $user, Post $post)
    {
        if ($user->can('delete-any-post')) {
            return true;
        }
        return $user->id === $post->user_id;
    }
}
