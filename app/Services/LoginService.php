<?php

namespace App\Services;

use Exception;

class LoginService
{
    public function execute(array $credetials)
    {
        if(!$token = auth('api')->setTTL(2*60)->attempt($credetials))
            throw new Exception('Not Authorization', 401);

            return [
                'token' => $token,
                'token_type' => 'Bearer',
                'expires_in' => auth()->factory()->getTTL(),
                'user' => auth()->user()
            ];
    }
}

