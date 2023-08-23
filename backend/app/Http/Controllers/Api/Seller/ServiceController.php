<?php

namespace App\Http\Controllers\Api\Seller;

use App\Http\Controllers\Api\Controller;
use App\Http\Controllers\Api\WishlistController;
use App\Http\Requests\ServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Http\Resources\Seller\ServiceResource;
use App\Models\Service;
use App\Models\ServiceImpression;
use App\Models\User;
use App\Services\Seller\SellerService;
use App\Traits\MediaTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    use MediaTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=auth()->user();
        $userID=isset($_GET['seller']) && !is_null($_GET['seller']) ? customDecrypt($_GET['seller']) : $user->id;

        $query = (new SellerService)->getService()->where('user_id',$userID);

        if(isset($_GET['status']) && !is_null($_GET['status']))
        {
          $this->filter($query,strtolower($_GET['status']));
        }

        $services = $query->groupBy("services.id")->latest()->simplePaginate(12);

        if(isset($_GET['seller']) && !is_null($_GET['seller'])){
            $services=(new WishlistController)->checkIfInWishlist($services);
        }

        return ServiceResource::collection($services);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        $user=auth()->user();
        $service=Service::create($request->safe()->except('banner')+[
            'user_id'=>$user->id,
            'slug' => $this->checkIfSlugExistOrNot(Str::slug($request->s_description, '-'))
        ]);
        $file=$this->uploadFile($request,'uploads/SellerMedia','banner',$service->id);

        $service=(new SellerService)->getService()->where('id',$service->id)->first();

        return $service && !empty($service) && $file
        ? response()->json(['data'=>new ServiceResource($service)],201)
        : response()->json(['message'=>'Request failed'],400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service=(new SellerService)->getService()
            ->where('id',customDecrypt($id))
            ->firstOrFail();

        if($service->user_id != auth()->id() ){
            $service->increment('total_clicks',1);
        }
        return new ServiceResource($service);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceRequest $request, $id,SellerService $service)
    {
        return $service->updateGig((object)$request->validated(),customDecrypt($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service=Service::findOrFail(customDecrypt($id))->delete();
        return $service
        ? response()->json(['message'=>'service deleted successfully'],200)
        : response()->json(['message'=>'Service Not Found'],400);
    }


    public function serviceclicks(Request $request)
    {

        request()->validate([
            'service_id' => ['required'],
        ]);

        $user=Service::where('id',customDecrypt($request->service_id))->first();
        $seriveclicks =ServiceImpression::create([
            'user_id' =>$user->user_id,
            'service_id'=>customDecrypt($request->service_id)
        ]);
        if($seriveclicks)
        {

            $usersclicks=User::where('id',$user->user_id)->first();
            $usersclicks->total_clicks=$usersclicks->total_clicks+1;
            $usersclicks->Save();
            return response()->json(['message'=>'service clicks added successfully']);
        }
        else
        return response()->json(['message'=>'service clicks not  added successfully']);


    }

    public function getRefererService($id)
    {
        $referer_service = Service::select('id','user_id','s_description')
        ->with(["UserService:id,username,image", "serviceMedia" => function($q){
            return $q->select('id','service_id','media')->latest()->take(1);
        }])
        ->where('id', customDecrypt($id))->firstOrFail();
        return new ServiceResource($referer_service);
    }

    public function filter($query,$status)
    {
        switch($status)
        {
          case "active" :
              $query->where('status',1);
              break;

          case "pending" :
              $query->where('status',0);
              break;

          case "unapproved" :
              $query->where('status',2);
              break;
        }
    }

    private function checkIfSlugExistOrNot($slug)
    {
        $slugExist = Service::where('slug',$slug)->first();

        if($slugExist) {
            $slug = Str::of($slug)->append('-'. Str::singular(Str::random(5)));
            $this->checkIfSlugExistOrNot($slug);
        }

        return $slug;
    }
}
