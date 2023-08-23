<?php

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;

if (!function_exists('abortIfValidationFails')) {
    function abortIfValidationFails($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->any()) {

                if (app()->environment('local')) {
                    Log::info('Request for api ' . request()->route()->getName() . '  error: ' . $validator->errors()->first() . '   Request: ' . json_encode(request()->all(), JSON_PRETTY_PRINT));
                }
                throw new HttpResponseException(response()->json([
                    'message' => $validator->errors()->first()
                ], 422));
            }
        });
    }
}
