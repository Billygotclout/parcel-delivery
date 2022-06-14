<?php

namespace App\Actions\Auth;


use App\Http\Resources\UserResource;
use App\Models\Imei;
use App\Models\User;
use App\Models\Wallet;
use App\Traits\ActivityLogTrait;
use App\Traits\ApiResponse;

class RegisterAction
{

    use ApiResponse, ActivityLogTrait;


    protected $user;
    protected $username;
    protected $data;

    public function execute(array $data)
    {
        


        $this->data = $data;


        $this->user = User::where('id', $data['user_id'])->first();

        $this->user->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => $data['username'],
            'gender' => $data['gender'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);


        // $this->user->sendEmailVerificationNotification();


        $this->createWallet();


        $userActivity = "{$this->user['first_name']} has registered";
        $email = $data['email'];

        $this->enterActivity($userActivity,$email );

        return $this->success([
            'token' => $this->user->createToken('API Token')->plainTextToken,
            'user_details' => new UserResource($this->user),

        ],null,  201);
    }

   

    private function createWallet()
    {
        $wallet = new Wallet();
        $wallet->user_id = $this->user->id;
        $wallet->save();
    }
}
