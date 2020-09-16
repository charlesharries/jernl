<?php

namespace App\Policies;

use App\User;
use App\UserPreferences;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPreferencesPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, UserPreferences $preferences)
    {
        return $preferences->user_id === $user->id;
    }
}
