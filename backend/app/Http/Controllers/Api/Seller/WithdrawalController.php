<?php

namespace App\Http\Controllers\Api\Seller;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\AddBankAccountRequest;
use App\Http\Resources\BankAccountResource;
use App\Models\SelleCardDetails;
use App\Models\WithdrawalRequest;
use App\Traits\StripeTrait;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    use StripeTrait;

    public function withdrawBalance()
    {
        return $this->payoutBalanceToConnectedAccount();
    }

    public function addBankAccount(AddBankAccountRequest $request)
    {
        $carddata = SelleCardDetails::where('user_id', auth()->user()->id)->first();
        if (empty($carddata)) {

            $user = auth()->user();
            $user->bankaccount_verified = 1;
            $user->save();
            SelleCardDetails::create([
                'iban' => $request->iban,
                'bank_name' => $request->bank_name,
                'bank_title' => $request->bank_title,
                'user_id' => auth()->user()->id,
            ]);
        } else {
            $carddata->iban = $request->iban;
            $carddata->bank_name = $request->bank_name;
            $carddata->bank_title = $request->bank_title;
            $carddata->save();
        }

        return response()->json(['message' => 'Account Verify Successfuly']);
    }

    public function BankAccount()
    {
        $carddetails = SelleCardDetails::where('user_id', auth()->user()->id)->firstOrFail();
        return  new BankAccountResource($carddetails);
    }

    public function withdrawRequest(Request $request)
    {
        $this->validateInput($request, [
            'amount' => 'required',
        ]);

        if (auth()->user()->availabe_balance < $request->amount) {
            return response()->json(['message' => 'Please send Valid Amount'],422);
        }
        $withdrawdetails = WithdrawalRequest::create([
            'amount' => $request->amount,
            'user_id' => auth()->user()->id,
        ]);
        if ($withdrawdetails)
            return response()->json(['message' => 'WithDraw Request Send Successfuly']);
    }

    public function getWithdrawalRequest()
    {
        return response()->json([
            "data" => WithdrawalRequest::select('amount','status','created_at')->where('user_id', auth()->id())->latest()->get()
        ]);
    }
}
