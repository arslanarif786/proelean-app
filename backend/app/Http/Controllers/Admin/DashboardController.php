<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\SubCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $date = Carbon::now()->subDays(30);
       $total_users=User::count();
       $lastThirtyDaysUsers=User::where('created_at','>=',$date)->count();
       $total_orders=Order::count();
       $total_lastThirtyDaysOrders=Order::where('created_at','>=',$date)->count();
       $total_category=Category::count();
       $total_subcategory=SubCategory::count();

       $sellers=Order::select(DB::raw('sum(orders.amount) as total_earning,count(orders.id) as total_orders,users.id,orders.seller_id,orders.id,users.name,users.available_balance'))->join('users','users.id','orders.seller_id')
       ->where('status_id',4)
       ->orderBy('total_earning','desc')
       ->groupBy('orders.seller_id')->get();
       return view('index',['total_category'=>$total_category,'total_user'=>$total_users,'lastThirtyDaysUsers'=>$lastThirtyDaysUsers,'total_subcategory'=>$total_subcategory,'total_orders'=>$total_orders,'total_lastThirtyDaysOrders'=>$total_lastThirtyDaysOrders,'sellers'=>$sellers]);
    }

    public function deleteUser(Request $request)
    {
        User::find(CustomDecrypt($request->user_id))->delete();
        return redirect()->back()->with('message', 'User Deleted  Successfuly!');
    }


    public function changeAdminPassword(Request $request)
    {
        $request->validate([
            'password' => ['nullable', 'string', 'min:6'],
            'password_confirmation' => ['nullable', 'required_with:password', 'same:password'],
            
        ]);
      

        if(!\Hash::check($request->current_password, auth()->user()->password)){

            return back()->with('error','You have entered wrong password');
       }
       auth()->user()->password=bcrypt($request->password);
       auth()->user()->save();
       auth()->logout();
    return redirect('/login');
    }


}
