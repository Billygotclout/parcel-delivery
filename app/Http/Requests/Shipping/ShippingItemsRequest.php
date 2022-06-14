<?php

namespace App\Http\Requests\Shipping;

use Illuminate\Foundation\Http\FormRequest;

class ShippingItemsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'item_name' => ['required', 'string'],
            'recipient_name' => ['required', 'string'],
            'recipient_number' => ['required'],
            'item_name' => ['required', 'string'],
            'parcel' => ['required', 'mimes:png,jpg,jpeg,gif|max:8000']
        ];
    }
}
