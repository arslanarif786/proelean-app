<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\Controller;
use App\Models\AvailableCurrency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{

    public function addcurrency(Request $request)
    {


        $request->validate([
            'name'=>'required',
            's_name'=>'required',
            'symbol'=>'required',
        ]);
        $language= AvailableCurrency::create([
            'currency' => $request->symbol,
            'name' => $request->name,
            's_name' => $request->s_name
        ]);
        if($language)
        return redirect()->back()->with('message', 'Currency Added  Successfuly!');
    }

    public function updateCurrency(Request $request)
    {
        $currency=AvailableCurrency::where('id',$request->currency_id)->first();

        return response()->json([$currency]);
    }


    public function editCurrency (Request $request)
    {
        $request->validate([
            'currency' => $request->symbol,


        ]);
        $currency= AvailableCurrency::where('id',$request->id)->first();
        $currency->currency =$request->symbol;
        $currency->name = $request->name;
        $currency->s_name = $request->s_name;
        $currency->save();
        return redirect()->back()->with('message', 'Language Update is Successfuly!');
    }


    public function deleteCurrency(Request $request)
    {
        AvailableCurrency::find(CustomDecrypt($request->currency_id))->delete();
        return redirect()->back()->with('message', 'Currency Deleted  Successfuly!');
    }


}
