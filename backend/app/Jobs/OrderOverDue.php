<?php

namespace App\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\{Service,User};
use App\Mail\Order\OrderLate;
use Illuminate\Support\Facades\Mail;

class OrderOverDue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $data=[];
    public function __construct($data)
    {
        $this->data=$data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // extract buyer & seller email's
        $buyer=User::find($this->data['buyer_id']);
        $seller=Service::find($this->data['service_id'])->UserService->user;
        $userMails=array($buyer->email,$seller->email);
        $email_data=new OrderLate($this->data);
        foreach($userMails as $email){
            Mail::to($email)->send($email_data);
        }
    }
}
