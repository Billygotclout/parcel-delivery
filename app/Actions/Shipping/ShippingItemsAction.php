<?php

namespace App\Actions\Shipping;

use App\Models\ShippingItems;
use App\Traits\ActivityLogTrait;
use App\Traits\ApiResponse;

class  ShippingItemsAction
{

    use ApiResponse,ActivityLogTrait;
    //
    public function uploadShippingItemDetails($data)
    {
        // $userId = auth()->user()->id;

        $shippingItems = [
            'user_id' => 1,
            'item_name' => $data['item_name'],
            'recipient_name' => $data['recipient_name'],
            'recipient_number' => $data['recipient_number'],
            'parcel_image' => $data['parcel_image']
        ];
        $ShippingItems  = ShippingItems::create($shippingItems);

        $userActivity = "Shipping Items Successfully saved";
        $email = auth()->user()->email;

        $this->enterActivity($userActivity,$email );

        return $this->success($ShippingItems, "Details Uploaded Successfully", 200);
    }
}


