<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use App\Models\Forum;
use Illuminate\Auth\Access\HandlesAuthorization;

class ForumPolicy
{
    use HandlesAuthorization;

 
    public function create(User $user)
    {
        return $user->isAdmin();
    }

   
    public function update(User $user)
    {
        return $user->isAdmin();
    }

    public function delete(User $user)
    {
        return $user->isAdmin();
    }
}