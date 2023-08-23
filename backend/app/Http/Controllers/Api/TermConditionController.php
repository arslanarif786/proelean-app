<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Models\Support;
use Illuminate\Http\Request;
// use GuzzleHttp\Psr7\Request;/
use Illuminate\Support\Facades\DB;

class TermConditionController extends Controller
{
    public function index()
    {
        $terms['privacy_policy']=DB::table('privacy_policies')->first();
        $terms['term_conditions']=DB::table('term_conditions')->first();
        return response()->json(['status'=>200,
            'message'=>'privacy&policy, term&condition',
            'data'=>$terms
        ]);
    }

    // get languages & currencies
    public function getLangCur()
    {
        $arr['languages']=DB::table('available_languages')->pluck('language')->toArray();
        $arr['currencies']=DB::table('available_currencies')->pluck('currency')->toArray();
        return response()->json(['status'=>200,'message'=>'language & currency list','data'=>$arr]);
    }

    public function support(Request $request)
    {

        $this->validateInput($request,[
            'subject'=>['required','min:6'],
            'description'=>['required','min:6']
            ]);
            $support=Support::create($request->only('subject','description')+array('user_id'=>auth()->id()));
            return $support && !empty($support)
            ? response()->json(['message'=>'Complaint Registered Successfully'],200)
            : response()->json(['message'=>'Request failed'],500);
    }
}
