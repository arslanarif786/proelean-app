<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function addCategory(Request $request)
    {


        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'file' => 'required|mimes:png,jpg,jpeg|max:2048',
        ]);
        $fileName = rand(111,999). time().'.'.$request->file->extension();
        $file=$request->file->move(public_path('uploads/categories'), $fileName);
        $category= Category::create([
            'title' => $request->name,
            'description' =>$request->description,
            'slug' => $this->checkIfSlugExistOrNot(Str::slug($request->name, '-')),
            'banner' =>'uploads/categories/'.$fileName,
        ]);
        if($category)
        return redirect()->back()->with('message', 'Category Added  Successfuly!');
    }


    public function updateCategory(Request $request)
    {
        $category=Category::where('id',CustomDecrypt($request->category_id))->first();

        return response()->json([$category]);
    }

    public function editCategory(Request $request)
    {
        $request->validate([
            'description' => ['required', 'string', 'max:255'],
            'file' => 'mimes:png,jpg,jpeg|max:2048',
            'title' => ['required'],

        ]);
        if($request->file)
        {
            $fileName = rand(111,999). time().'.'.$request->file->extension();
            $file=$request->file->move(public_path('uploads/categories/'), $fileName);
        }
        if($request->file){

            if($request->banner){
                unlink($request->banner);
            }
        }
        $category=Category::where('id',$request->id)->first();
        $category->title = $request->title;
        $category->banner = isset($fileName)?'uploads/categories/'.$fileName: $category->banner;
        $category->description = $request->description;
        $category->save();
        return redirect()->back()->with('message', 'Category Update is Successfuly!');
    }


    public function deteleCategory(Request $request)
    {
        Category::find(CustomDecrypt($request->category_id))->delete();
        return redirect()->back()->with('message', 'Category Deleted  Successfuly!');
    }


    public function addsubCategory(Request $request)
    {


        $request->validate([
            'name'=>'required',
            'category_id'=>'required',
            'file' => 'required|mimes:png,jpg,jpeg|max:2048',
        ]);
        $fileName = rand(111,999). time().'.'.$request->file->extension();
        $file=$request->file->move(public_path('uploads/subcategories'), $fileName);
        $category= SubCategory::create([
            'title' => $request->name,
            'category_id' =>$request->category_id,
            'banner' =>'uploads/subcategories/'.$fileName,
        ]);
        if($category)
        return redirect()->back()->with('message', 'SubCategory Added  Successfuly!');
    }


    public function deleteSubCategory(Request $request)
    {
        SubCategory::find(CustomDecrypt($request->id))->delete();
        return redirect()->back()->with('message', 'SubCategory Deleted  Successfuly!');
    }



    public function updateSubCategory(Request $request)
    {
        $subcategory=SubCategory::where('id',CustomDecrypt($request->subcategory_id))->first();
        $categories=Category::all();

        return response()->json(['categories' => $categories,'subcategory'=>$subcategory]);
    }

    public function editSubCategory(Request $request)
    {
        $request->validate([
            'category_id' => ['required', 'string', 'max:255'],
            'file' => 'mimes:png,jpg,jpeg|max:2048',
            'name' => ['required'],

        ]);
        if($request->file)
        {
            $fileName = rand(111,999). time().'.'.$request->file->extension();
            $file=$request->file->move(public_path('uploads/subcategories/'), $fileName);
        }
        if($request->file){

            if($request->banner){
                unlink($request->banner);
            }
        }
        $subcategory=SubCategory::where('id',$request->id)->first();
        $subcategory->title = $request->name;
        $subcategory->banner = isset($fileName)?'uploads/subcategories/'.$fileName: $subcategory->banner;
        $subcategory->category_id = $request->category_id;
        $subcategory->save();
        return redirect()->back()->with('message', 'SubCategory Update is Successfuly!');
    }

    private function checkIfSlugExistOrNot($slug)
    {
        $slugExist = Category::where('slug',$slug)->first();

        if($slugExist) {
            $slug = Str::of($slug)->append('-'. Str::singular(Str::random(5)));
            $this->checkIfSlugExistOrNot($slug);
        }

        return $slug;
    }
}
