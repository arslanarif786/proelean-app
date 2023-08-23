<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\CreateCardTokenRequest;
use App\Traits\StripeTrait;
use App\Services\PaymentService;

class PaymentController extends Controller
{
    use StripeTrait;

    public function create(CreateCardTokenRequest $request)
    {
        return $this->createCardToken($request);
    }

    public function connectStripeAccount()
    {
        return (new PaymentService)->createStripeAccount();
    }
}
