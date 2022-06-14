<?php

namespace App\Actions\Auth;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ActivityLogTrait;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;

class LoginAction
{
    
    use ApiResponse;

    public function execute($data)
    {

        $user = $this->checkIfUserExists($data['phone']);

        if (!isset($user->phone)) {
            return $this->error('User does not exist, please proceed to the register page', 401);
        }
        if (!Auth::attempt($data)) {
            return $this->error('Credentials not match', 401);
        }

        return $this->success([
            'token' => auth()->user()->createToken('API Token')->plainTextToken,
            new UserResource(auth()->user())
        ], 'login successful');
    }
    public function checkIfUserExists($phone)
    {
        return User::where('phone', $phone)->first();
    }
}
