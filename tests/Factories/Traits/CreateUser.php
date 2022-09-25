<?php

namespace Tests\Factories\Traits;

use App\Models\User;
use App\Models\UserProfile;

trait CreateUser
{
    private function createUser(): User
    {
        $user = User::factory()->create();
        $user->profile()->save(UserProfile::factory()->make());

        return $user;
    }
}

