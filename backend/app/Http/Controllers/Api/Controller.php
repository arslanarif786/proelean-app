<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function validateInput($request, $rules)
    {
        $data = !is_array($request) ? $request->input() : $request;
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            http_response_code(422);
            die(json_encode(['message' => $validator->errors()->first()]));
        }
    }

    protected function getDeviceId()
    {
        return request()->header('Device-id') ?: null;
    }

}
