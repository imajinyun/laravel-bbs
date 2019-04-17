<?php

namespace Tests\Traits;

use Auth;
use App\Models\User;

trait JWTTokenTrait
{
    public function withAuthorizationHeader(User $user)
    {
        $token = Auth::guard('api')->fromUser($user);
        $this->withHeaders(['Authorization' => 'Bearer ' . $token]);

        return $this;
    }
}
