<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Jenssegers\Agent\Agent;

trait ActivityLogTrait
{

    protected $activityLog;
    public function __construct(
        ActivityLog $activityLog
    ) {
        $this->activityLog = $activityLog;
    }

    public function enterActivity($user_activity, $email)
    {
        $agent = new Agent();
      
        $this->activityLog->create([
           
            'device' => $agent->device(),
            'user_id' => 1,
            'user_email' => $email,
            'user_activity' => $user_activity
        ]);
    }

    
}
