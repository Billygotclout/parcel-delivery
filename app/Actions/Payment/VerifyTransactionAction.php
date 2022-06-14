<?php

namespace App\Actions\Payment;

use App\Models\CardDetails;
use App\Models\Wallet;
use App\Traits\ActivityLogTrait;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Http;

class VerifyTransactionAction
{
    protected $data;
    use ApiResponse, ActivityLogTrait;

    public function execute(array $data)
    {

        $this->data = $data;
        $userId = auth()->user()->id;


        $payload = [
            'transaction_id' => $this->data['transaction_id']
        ];


        $this->url = (config('keys.flutterwave.base_url')) . "/transactions/{$data['transaction_id']}/verify";
        $this->secretKey = (config('keys.flutterwave.secret_key'));

        $verifyTransaction = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer {$this->secretKey}"
        ])->get($this->url, $payload)->json();
        // dd($verifyTransaction);

        $userActivity = "Card Details Successfully saved";
        $email = auth()->user()->email;

        $this->enterActivity($userActivity,$email );

        $carddetails = CardDetails::create([
                'user_id' => auth()->user()->id,
                "first_6digits" => $verifyTransaction['data']['card']['first_6digits'],
                "last_4digits" => $verifyTransaction['data']['card']['last_4digits'],
                "expiry" => $verifyTransaction['data']['card']['expiry'],
                "type" => $verifyTransaction['data']['card']['type'],
                "token" => $verifyTransaction['data']['card']['token'],
                "email" => $verifyTransaction['data']['customer']['email'],
            ]);

      
        $userWallet = Wallet::where('user_id', $userId)->first();
        $newBalalnce = $userWallet->amount + $verifyTransaction['data'] ['amount'];

        $userWallet->update(['amount' => $newBalalnce]);

        return $this->success($carddetails, "Transactions successfully verified", 200);
    }
}
