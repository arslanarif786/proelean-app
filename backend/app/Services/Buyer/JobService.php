<?php

namespace App\Services\Buyer;

use App\Models\Job;

/**
 * Class JobService
 * @package App\Services
 */
class JobService
{
    public function getJobs()
    {
        $jobColumns=['id','user_id','category_id','sub_category_id','offers','slug','featured','description','budget','delivery_time','cinic','offers','created_at'];
        $user='id,name,username,image';
        // $offerColumns='id,job_id,user_id,service_id,delivery_time,description,price';
        return Job::select($jobColumns)->with(["JobOffer.user:$user"]);
    }

}
