<?php


namespace App\Actions\Profile;

use App\Models\User;
use App\Traits\ActivityLogTrait;
use App\Traits\ApiResponse;
use GuzzleHttp\Psr7\Request;

class AddProfilePictureAction
{
    use ApiResponse, ActivityLogTrait;


    public function execute(array $request)
    {

        User::where('id', $request['user_id'])
        ->update([
            'profile_picture' => $request['profile_picture'],
        ]);
        $userActivity = "Profile Picture Successfully saved";
        $email = auth()->user()->email;

        $this->enterActivity($userActivity,$email );
  
        return $this->success(null, 'data updated successfully');
    }
}
