<?php

namespace App\Http\Controllers\Shipping;

use App\Actions\Shipping\ShippingItemsAction;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shipping\ShippingItemsRequest;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class ShippingItemsController extends Controller
{
    //
    public function itemsDetails(ShippingItemsRequest  $request)
    {


        $url = URL::to('/');

      

        if ($request->file('parcel')) {
          

            $uploadFolder = 'shippingItems';

            $image = $request->file('parcel');

            $image_uploaded_path = $image->store($uploadFolder, 'public');

          
            $request['parcel_image'] = $url . '/storage/' . $image_uploaded_path;

        
            
        }

        return (new ShippingItemsAction(new ActivityLog()))->uploadShippingItemDetails($request->all());
    }
}
