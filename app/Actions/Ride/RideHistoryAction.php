<?php

namespace App\Actions\Ride;

use App\Models\User;
use App\Models\UserRide;
use App\Traits\ApiResponse;

class RideHistoryAction
{


    use ApiResponse;

    public function execute()
    {
        $userId = auth()->user()->id;

        return UserRide::where('user_id', $userId)->take(3)->get();
    }
}
