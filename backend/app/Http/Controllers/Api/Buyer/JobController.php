<?php

namespace App\Http\Controllers\Api\Buyer;

use App\Http\Controllers\Api\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Requests\JobRequest;
use App\Http\Resources\Buyer\JobResource;
use App\Services\Buyer\JobService;
use App\Traits\MediaTrait;
use Illuminate\Support\Str;

class JobController extends Controller
{
    use MediaTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query=(new JobService)->getJobs()->where('user_id',auth()->id());
        if(isset($_GET['status']) && !is_null($_GET['status']))
        {
          $this->filter($query,strtolower($_GET['status']));
        }
        $userJob = $query->latest()->simplePaginate(12);
        return JobResource::collection($userJob);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobRequest $request)
    {
        if($request->hasFile('cinic') && !empty($request->file('cinic'))){
            $path=$this->uploadFile($request,'uploads/BuyerDocs','cinic');
        }
        $validatedData=$request->safe()->except(['cinic']);
        $job=Job::create($validatedData+[
            'user_id'=>auth()->id(),
            'slug' => Str::slug($request->description, '-'),
            'cinic'=> $request->hasFile('cinic') && isset($path) ? $path : null
        ]);
        return $job
        ? new JobResource($job)
        : response()->json(['message'=>'Request failed'],400);
    }

    /**k
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job=(new JobService)->getJobs()->where('id',customDecrypt($id))->where('user_id',auth()->id())->firstOrFail();
        return new JobResource($job);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $job=(new JobService)->getJobs()->where('id',customDecrypt($id))->where('user_id',auth()->id())->firstOrFail();
        return $job->delete()
        ? response()->json(['message'=>'job deleted successfully'],200)
        : response()->json(['message'=>'Request failed'],400);
    }

    private function filter($query,$status){
        if($status=='pending'){
            $query=$query->where('status',0);
        }
        else if($status=='active'){
            $query=$query->where('status',1);
        }
        return $query;
    }
}
