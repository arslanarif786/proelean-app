<?php

namespace App\Console\Commands;

use App\Jobs\OrderOverDue;
use Illuminate\Console\Command;
use App\Models\Order;
use Carbon\Carbon;



class CheckOrderCompletionDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check-order-completion-date';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check order completion date';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $orders=Order::where('status_id','!=',4)
            ->where('emailed',0)
            ->whereDate('end_date','<=',Carbon::now())->get();

        if(!$orders){
            return Command::SUCCESS;
        }

        foreach($orders as $order)
        {
            $order->update([
                'status_id'=>7,
                'emailed'=>1
            ]);
            $emailData=[
                'buyer_id'=>$order->user_id,
                'service_id'=>$order->service_id,
                'order_no'=>$order->orderNo
            ];
            dispatch(new OrderOverDue($emailData));
        }
        return Command::SUCCESS;
    }
}
