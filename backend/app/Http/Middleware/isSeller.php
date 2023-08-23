<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isSeller
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
        $user = auth()->user();
        if ($user &&  $user->isFreelancer == 1) {
            return $next($request);
        }

        if (strpos(url()->current(), '/api/') !== false) {
            return response()->json(['message' => 'Only sellers are authorized for this action'], 403);
        }
    }
}
