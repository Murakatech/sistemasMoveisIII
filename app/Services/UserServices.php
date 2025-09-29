<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserServices
{
    public function __construct(private User $user) {}

    public function store(array $data): User
    {
        return $this->user->create($data);
    }

    public function edit()
    {
        return auth()->user();
    }

    public function update(array $data, User $user)
    {

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        return $user->update($data);

    }

}
