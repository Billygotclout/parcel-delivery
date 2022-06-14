<?php

namespace App\Http\Controllers\Profile;

use App\Actions\Profile\AddProfilePictureAction;
use App\Actions\Profile\GetUserDetailsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\ProfilePictureRequest;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class ProfileController extends Controller
{
    public function getUserDetails()
    {
        return (new GetUserDetailsAction)->execute();
    }


    public function addProfilePicture(ProfilePictureRequest $request)
    {

        $url = URL::to('/');

      

        if ($request->file('profile')) {
          

            $uploadFolder = 'users';

            $image = $request->file('profile');

            $image_uploaded_path = $image->store($uploadFolder, 'public');

          
            $request['profile_picture'] = $url . '/storage/' . $image_uploaded_path;

        
            
        }
        return (new AddProfilePictureAction(new ActivityLog()))->execute($request->all());
    }
}
