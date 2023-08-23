<?php

namespace App\Observers;

use App\Models\Job;
use App\Models\JobOffer;
use App\Models\Order;
use Carbon\Carbon;

class OrderObserver
{
    public function creating(Order $order){
        // initialize end time
        if(isset($order->delivery_time) && !empty($order->delivery_time)){
            $days=(int)ltrim($order->delivery_time, 'A..z: ');
            $order->end_date=Carbon::now()->addDays($days);
        }
        if(!is_null($order->job_id)){
            JobOffer::where('job_id',$order->job_id)->update([
                'status'=>'0'
            ]);
        }

        if(!is_null($order->job_id)){
            Job::where('id',$order->job_id)->update([
                'offers'=>'0'
            ]);
        }
    }
}
