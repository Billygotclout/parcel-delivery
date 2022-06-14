<?php

namespace App\Http\Controllers\Payments;

use App\Actions\Payment\GetCardDetailsAction;
use App\Actions\Payment\VerifyTransactionAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payments\VerifyTransactionRequest;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function verifyTransaction(VerifyTransactionRequest $request)
   {

      return (new VerifyTransactionAction(new ActivityLog()))->execute($request->validated());
   }

   public function getCardDetails()
   {
      return (new GetCardDetailsAction)->execute();
   }
}
