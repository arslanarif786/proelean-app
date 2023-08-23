<?php

namespace App\Http\Middleware;

use App\Models\Order;
use App\Models\Service;
use Closure;
use Illuminate\Http\Request;

class CheckOrder
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $service = Service::findOrFail(customDecrypt($request->service_id));

        return $service->user_id == auth()->id()
        ? response()->json(['message'=>'You cannot purchase your own service'],401)
        : $next($request);
    }
}
