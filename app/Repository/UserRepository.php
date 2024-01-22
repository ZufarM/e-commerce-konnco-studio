<?php

namespace App\Repository;

use App\Models\User;

class UserRepository
{

    public function create($data)
    {
        $data['password'] = bcrypt($data['password']);
        return User::create($data);
    }

    public function getUserById($id)
    {
        return User::find($id);
    }
}
