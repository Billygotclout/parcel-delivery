<?php

namespace App\Http\Controllers\Rides;

use App\Actions\Ride\RideHistoryAction;
use App\Actions\Ride\UserRideAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Rides\UserRideRequest;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class RidesController extends Controller
{
    public function rides(UserRideRequest $request)
    {
        return (new UserRideAction(new ActivityLog()))->execute($request->validated());
    }

    public function rideHistory()
    {
        return (new RideHistoryAction)->execute();
    }
}
