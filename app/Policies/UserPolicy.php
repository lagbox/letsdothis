<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    // allow an admin to pass through
    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    public function show(User $user, User $other)
    {
        return $this->owner($user, $other);
    }

    public function edit(User $user, User $other)
    {
        return $this->owner($user, $other);
    }

    public function update(User $user, User $other)
    {
        return $this->edit($user, $other);
    }

    public function delete(User $user, User $other)
    {
        return $this->edit($user, $other);
    }

    protected function owner(User $user, User $other)
    {
        return $user->id == $other->id;
    }
}
