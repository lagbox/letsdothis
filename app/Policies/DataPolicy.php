<?php

namespace App\Policies;

use App\Data;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DataPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    public function edit(User $user, Data $data)
    {
        return $this->owner($user, $data);
    }

    public function update(User $user, Data $data)
    {
        return $this->edit($user, $data);
    }

    public function delete(User $user, Data $data)
    {
        return $this->edit($user, $data);
    }

    protected function owner(User $user, Data $data)
    {
        return $data->user_id == $user->id;
    }
}
