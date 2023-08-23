<?php

namespace App\Services\Seller;

use App\Http\Controllers\Api\WishlistController;
use App\Http\Resources\Seller\AnalyticResource;
use App\Http\Resources\Buyer\JobResource;
use App\Http\Resources\Seller\ServiceResource;
use App\Http\Resources\Seller\ServiceReviewResource;
use App\Jobs\saveServiceImpression;
use App\Models\Job;
use App\Models\JobOffer;
use App\Models\Order;
use App\Models\UserDetail;
use App\Models\Service;
use App\Models\ServiceImpression;
use App\Models\ServiceReview;
use App\Models\User;
use App\Traits\MediaTrait;
use App\Traits\FCMNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Class SellerService
 * @package App\Services
 */
class SellerService
{

    use MediaTrait;
    use FCMNotification;

    // BECOME FREELANCER
    public function BecomeSeller($request)
    {
        $user = auth()->user();
        $request = request();
        $file = $this->uploadFile($request, 'uploads/FreelancerCinic', 'cinic');
        $freelancer = UserDetail::create($request->except(['is_verified', 'cinic', 'balance']) + [
            'user_id' => $user->id,
            'cinic' => $file
        ]);
        if ($freelancer) {
            $user->isFreelancer = 1;
            $user->lang = $request->lang;
            $user->description = $request->description;
            $user->save();
            return  response()->json(['message' => 'Your Role Has Been Submitted Successfully !'], 201);
        }
        return response()->json(['message' => 'Request failed'], 400);
    }
    public function updateGig($request, $id)
    {
        $request = request();
        $service = Service::findOrFail(customDecrypt($id));
        $media = $this->uploadFile($request, 'uploads/SellerMedia', 'banner', $id);
        $isUpdated = $service->update($request->except(['banner', 'status', 'featured', 'rating', 'total_reviews']));

        if ($request->has('delete') && is_array($request->delete) && !empty($request->delete)) {
            $countMedia = $this->countServiceMedia($id);
            if ($countMedia->total_media < 2) {
                return response()->json(['message' => 'Unable To Remove It At Least One Media File Required..!'], 403);
            } else {
                //-CHECK IF FILE EXIST OR NOT
                foreach ($request->delete as $del_item) {
                    $itemToBeDelete = urldecode($del_item);
                    $itemToBeDelete = trim($itemToBeDelete, '"');
                    if (!empty($del_item) && file_exists($itemToBeDelete)) {
                        DB::table('service_media')->where('media', $itemToBeDelete)->delete();
                        unlink($itemToBeDelete);
                    } else {
                        die(json_encode(['message' => 'That File No More Exist..!'], 404));
                    }
                }
            }
        }
        return $isUpdated
            ? new ServiceResource($this->getService()->where('id', $service->id)->first())
            : response()->json(['message' => 'Request failed'], 400);
    }

    public function returnSellerReviews($id)
    {
        $serviceIds = User::findOrFail($id)->Services->pluck('id')->toArray();
        $reviews = ServiceReview::with(['user:id,username,image'])->whereIn('service_id', $serviceIds)->latest()->simplePaginate(12);
        return ServiceReviewResource::collection($reviews);
    }

    public function analytics()
    {
        $user = auth()->user();
        $year = now()->year;
        $month = now()->month;

        $yearstart = $year . '-01-' . '01' . ' ' . '00:00:00';
        $yearend = $year . '-12-' . '31' . ' ' . '23:59:59';

        $date = Carbon::parse($year . "-" . $month . "-01");

        $monthstart = $date->startOfMonth()->format('Y-m-d H:i:s');
        $monthend = $date->endOfMonth()->format('Y-m-d H:i:s');

        $monthlyearning = Order::select(DB::raw('SUM(orders.amount) as monthly_earning'))
            ->whereBetween('created_at', [$monthstart, $monthend])
            ->where('seller_id', $user->id)->where('status_id', 4)->get();
            
        $yearearning = Order::select(DB::raw('SUM(orders.amount) as year_earning'))
            ->whereBetween('created_at', [$yearstart, $yearend])
            ->where('seller_id', $user->id)->where('status_id', 4)->get();

        $weeklyearning = Order::select(DB::raw('SUM(orders.amount) as weekly_earning'))
            ->whereBetween('created_at', [Carbon::now()->subDays(6), Carbon::now()])
            ->where('seller_id', $user->id)->where('status_id', 4)
            ->get();

        $totalearning = Order::select(DB::raw('SUM(orders.amount) as total_earning'))
            ->where('seller_id', $user->id)->where('status_id', 4)
            ->get();

        $impressions = ServiceImpression::selectRaw("count(case when type='impression' then 1 end) as impressions")
        ->selectRaw("count(case when type='click' then 1 end) as clicks")
            ->join('services', 'services.id', '=', 'service_impressions.service_id')
            ->join('users', 'users.id', '=', 'services.user_id')
            ->where('services.user_id', $user->id)
            ->first();

        $analytics = (object)[
            'weekly_earning' => isset($weeklyearning[0]->weekly_earning) ? $weeklyearning[0]->weekly_earning : 0,
            'year_earning' => isset($yearearning[0]->year_earning) ? $yearearning[0]->year_earning : 0,
            'monthly_earning' => isset($monthlyearning[0]->monthly_earning) ? $monthlyearning[0]->monthly_earning : 0,
            'total_earning' => isset($totalearning[0]->total_earning) ? $totalearning[0]->total_earning : 0,
            'current_balance' => $user->available_balance,
            'active_orders' => $user->active_orders,
            'impressions' => $impressions?->impressions ?: 0,
            'clicks' => $impressions?->clicks ?: 0,
            'analytics' => $this->weeklyAnalytics()
        ];

        return new AnalyticResource($analytics);
    }


    public function weeklyAnalytics()
    {
        $user = auth()->user();

        $weeklyImpression = ServiceImpression::select(DB::raw('count(service_impressions.id) as impression,DATE(created_at) as date'))->where('type', 'impression')
            ->whereBetween('created_at', [Carbon::now()->subDays(6), Carbon::now()])
            ->where('user_id', $user->id)->groupBy('date')->get();

        $weeklyClicks = ServiceImpression::select(DB::raw('count(service_impressions.id) as clicks,DATE(created_at) as date
        '))->where('type', 'click')
            ->whereBetween('created_at', [Carbon::now()->subDays(6), Carbon::now()])
            ->where('user_id', $user->id)->groupBy('date')->get();


        $analytics = [];
        for ($i = 0; $i < 7; $i++) {
            $date = now()->subDays($i)->format('Y-m-d');
            $day = now()->subDays($i)->format('l');
            $day = substr($day, 0, 3);
            $analytics[] = (object)[
                'impressions' => 0,
                'clicks' => 0,
                'date' => $date,
                'day' => $day
            ];
        }


        foreach ($analytics as $data) {

            foreach ($weeklyClicks as $wc) {
                if ($data->date == $wc->date) {
                    $data->clicks = (int) $wc->clicks;
                }
            }

            foreach ($weeklyImpression as $wi) {
                if ($data->date == $wi->date) {
                    $data->impressions = (int) $wi->impression;
                }
            }
        }

        return $analytics;
    }

    public function getJobList()
    {
        $user = auth()->user();
        $cancelledJobs = DB::table('cancel_offers')->where('user_id', $user->id)->pluck('job_id')->toArray();
        $query = Job::with(["user:id,username,image"])
            ->doesnthave('order')
            ->where('status', 0)
            ->where("user_id", "!=", $user->id);

        if (isset($_GET['status']) && !is_null($_GET['status']) && strtolower($_GET['status']) == "sent_offers") {
            $query = $query->whereRelation('JobOffer', 'user_id', $user->id);
        }
        $jobs = $query->whereNotIn('id', $cancelledJobs)->latest()->paginate(20);
        $jobIds = $jobs->pluck('id')->toArray();
        $appliedJobIDs = $this->returnJobIdsWHereIhaveApplied($jobIds, $user->id);
        foreach ($jobs as $job) {
            $job->is_applied = in_array($job->id, $appliedJobIDs) ? 1 : 0;
        }
        return JobResource::collection($jobs);
    }

    public function getService()
    {
        $service = ['services.id', 'user_id', 'services.category_id', 'sub_category_id', 'services.description', 'services.slug', 's_description', 'price', 'delivery_time', 'additional_info', 'rating', 'revision', 'total_reviews', 'total_clicks', 'lat', 'lng'];
        $user = 'id,name,username,description,image,user_rating,users.total_reviews,created_at';
        $media = 'id,service_id,media';
        $query = Service::select($service)->with(["category:id,title", "subCategory:id,title", "UserService:$user", "ServiceMedia:$media"]);
        return $query;
    }


    public function searchServices($q)
    {
        $query = $this->getService()
            ->select('services.*')
            ->join('users', 'users.id', '=', 'services.user_id')
            ->join('categories', 'categories.id', '=', 'services.category_id')
            ->where(function ($qry) use ($q) {
                $qry->where('users.name', 'like', "%$q%")
                    ->orWhere('services.s_description', 'like', "%$q%")
                    ->orWhere('services.slug', 'like', "%$q%")
                    ->orWhere('services.description', 'like', "%$q%")
                    ->orWhere('services.additional_info', 'like', "%$q%")
                    ->orWhere('categories.title', 'like', "%$q%")
                    ->orWhere('categories.slug', 'like', "%$q%")
                    ->orderByRaw('
            CASE
            when services.s_description LIKE "$q% THEN 1
            when services.slug LIKE "$q% THEN 2
            when users.name LIKE "%$q% THEN 3
            when services.description LIKE "%$q% THEN 4
            else
               5
               END desc
            ');
            })->when(auth()->id(), function($q) {
                $q->where('user_id', '!=', auth()->id());
            });

        if (($_GET['category'] ?? null) && !empty($_GET['category'])) {
            $query = $query->where('categories.slug', $_GET['category']);
        }

        // filter by price
        if (isset($_GET['filter'])) {
            switch (strtolower($_GET['filter'])) {
                case "price<":
                    $query = $query->where('services.price', '<=', (float)$_GET['filter_value']);
                    break;

                case "price>":
                    $query = $query->where('services.price', '>=', (float)$_GET['filter_value']);
                    break;

                case "price":
                    $price = explode(',', $_GET['filter_value']);
                    for ($i = 0; $i < sizeof($price); $i++) {
                        $price[$i] = (float)$price[$i];
                    }
                    $query = $query->whereBetween('services.price', $price);
                    break;
            }
        }

        $services = $query->groupBy('services.id')->orderByDesc('services.rating')->paginate(12);

        // check if in wishlist
        $services = (new WishlistController)->checkIfInWishlist($services);
        saveServiceImpression::dispatchAfterResponse($services);
        return ServiceResource::collection($services);
    }

    public function sendOfferToJob($request)
    {
        $request = request();
        $user = auth()->user();
        $this->isOfferExist($request, $user->id);
        $jobID = customDecrypt($request->job_id);
        $jobUser = Job::findOrFail(customDecrypt($request->job_id))->user;
        Job::find($jobID)->increment('offers', 1);
        $isSent = JobOffer::create($request->except(['status', 'active', 'service_id', 'job_id']) + [
            'user_id' => $user->id,
            'service_id' => customDecrypt($request->service_id),
            'job_id' => $jobID
        ]);

        $this->sendNotification($jobUser->id, $user->name, 'Has sent you an offer on your job', $jobID, "OFFER");
        return $isSent
            ? response()->json(['message' => 'Offer has been sent successfully..!'], 200)
            : response()->json(['message' => 'Request failed'], 400);
    }

    private function returnJobIdsWHereIhaveApplied($jobIds, $userID)
    {
        return JobOffer::whereIn('job_id', $jobIds)->where('user_id', $userID)->pluck('job_id')->toArray();
    }

    public function getServiceAvgRating($serviceID)
    {
        $service_reviews = ServiceReview::where('service_id', $serviceID)->get();
        $service['rating'] = $service_reviews->avg('rating');
        $service['reviews'] = $service_reviews->count('rating');
        return $service;
    }

    public function getUserAvgRating($serviceIDs)
    {
        $service_reviews = ServiceReview::whereIn('service_id', $serviceIDs)->get();
        $Userservices['rating'] = $service_reviews->avg('rating');
        $Userservices['reviews'] = $service_reviews->count('rating');
        return $Userservices;
    }

    private function isOfferExist($request, $userID)
    {
        $exist = DB::table('job_offers')
            ->where('service_id', customDecrypt($request->service_id))
            ->where('job_id', customDecrypt($request->job_id))
            ->where('user_id', $userID)->first();
        if ($exist) {
            die(json_encode(['message' => 'Your request already applied'], 403));
        }
    }
}
