<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\Controller;
use App\Models\AvailableLanguage;
use Illuminate\Http\Request;

class LanguageController extends Controller
{

    public function addlangauge(Request $request)
    {


        $request->validate([
            'name'=>'required',
        ]);
        $language= AvailableLanguage::create([
            'language' => $request->name
        ]);
        if($language)
        return redirect()->back()->with('message', 'Language Added  Successfuly!');
    }


    public function updatelanguage(Request $request)
    {
        $language=AvailableLanguage::where('id',CustomDecrypt($request->language_id))->first();
        return response()->json([$language]);
    }


    public function editlanguage (Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],

        ]);
        $language= AvailableLanguage::where('id',$request->id)->first();
        $language->language = $request->name;
        $language->save();
        return redirect()->back()->with('message', 'Language Update is Successfuly!');
    }


    public function deleteLanguage(Request $request)
    {
        AvailableLanguage::find(CustomDecrypt($request->langauge_id))->delete();
        return redirect()->back()->with('message', 'Language Deleted  Successfuly!');
    }


}
