<?php

namespace App\Actions\Ride;

use App\Models\UserRide;
use App\Traits\ActivityLogTrait;
use App\Traits\ApiResponse;


class UserRideAction
{
    use ApiResponse,ActivityLogTrait;

    public function execute($data)
    {

        $userId = auth()->user()->id;

        $userRide = [
            'user_id' => $userId,
            'current_location' => $data['current_location'],
            'destination' => $data['destination']
        ];

        $Usersride  = UserRide::create($userRide);

        $userActivity = "Ride Successfully saved";
        $email = auth()->user()->email;

        $this->enterActivity($userActivity,$email );

        return $this->success($Usersride, "Ride successfully saved", 200);
    }
}
