<?php

namespace App\Jobs;

use App\Mail\{NewOrder,WelcomeToProelean,EmailVerification,ServiceCreated,RefundOrder};
use App\Mail\Buyer\OrderState as BuyerOrder;
use App\Mail\Buyer\JobCreated;
use App\Mail\Seller\OrderState as SellerOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $data=[];
    public $email_data;
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

        switch($this->data['mailTo']){
            case 'user':
                if(strtolower($this->data['mailFor']) == 'verification'){
                    $this->email_data = new EmailVerification($this->data);
                    Mail::to($this->data['user_email'])->send($this->email_data);
                }
            break;

            case 'seller':
                // GET SELLER NOTIFY ON CREATING SERVICE
                if(strtolower($this->data['mailFor']) == 'oncreateservice'){
                    $this->email_data = new ServiceCreated($this->data);
                    Mail::to($this->data['seller_email'])->send($this->email_data);
                    break;
                }

                // GET SELLER NOTIFY ON BECOMING FREELANCER
                if(strtolower($this->data['mailFor']) == 'welcomeseller'){
                    $this->email_data = new WelcomeToProelean();
                    Mail::to($this->data['seller_email'])->send($this->email_data);
                    break;
                }

                // GET SELLER NOTIFY ON NEW ORDER
                if(strtolower($this->data['mailFor']) == 'neworder'){
                    $this->email_data = new NewOrder($this->data);
                }
                // GET SELLER NOTIFY ON ORDER STATE CHANGE
                if(strtolower($this->data['mailFor']) == 'manage_order'){

                    $orderNo=$this->data['order_no'];
                    switch($this->data['status']){
                        case 3:
                            $this->data['state']=" wants revision on your order #$orderNo delivery!";
                        break;

                        case 4:
                            $this->data['state']=" marked your order #$orderNo as completed!";
                        break;

                        case 5:
                            $this->data['state']=" disputed on order #$orderNo";
                        break;
                    }
                    $this->email_data = new SellerOrder($this->data);
                }

                Mail::to($this->data['seller_email'])->send($this->email_data);

            break;

            case 'buyer':

                // GET BUYER NOTIFY ON JOBS CREATED
                if(strtolower($this->data['mailFor']) == 'oncreatejob')
                {
                    $this->email_data=new JobCreated($this->data);
                }

                // GET BUYER NOTIFY ON ORDER STATE CHANGE
                if(strtolower($this->data['mailFor']) == 'manage_order'){
                    $orderNo=$this->data['order_no'];
                    switch($this->data['status']){
                        case 2:
                            $this->data['state']=" has submited your order #$orderNo";
                        break;

                        case 5:
                            $this->data['state']=" has marked your  order #$orderNo as disputed";
                        break;

                        case 6:
                            $this->data['state']=" wants to cancel the order #$orderNo";
                        break;
                    }
                    $this->email_data = new BuyerOrder($this->data);
                }

                // GET BUYER NOTIFY ON REFUND APPLICATION
                if(strtolower($this->data['mailFor']) == 'refund')
                {
                    $this->email_data=new RefundOrder($this->data);
                }
                Mail::to($this->data['buyer_email'])->send($this->email_data);
            break;


        }


    }

}
