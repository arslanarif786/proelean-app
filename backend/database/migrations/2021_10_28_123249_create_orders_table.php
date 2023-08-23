<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('service_id')->constrained();
            $table->foreignId('seller_id')->constrained('users');
            $table->foreignId('status_id')->constrained('order_statuses');
            $table->foreignId('job_id')->nullable();
            $table->double('amount');
            $table->tinyInteger('status')->default(1);
            $table->string('orderNo');
            $table->string('description')->nullable();
            $table->string('type');
            $table->foreignId('custom_offer_id')->nullable()->constrained();
            $table->tinyInteger('revision')->default(0);
            $table->tinyInteger('watch')->default(0);
            $table->string('notes')->nullable();
            $table->tinyInteger('started')->default(0);
            $table->string('delivery_time')->nullable();
            $table->string('delivery_note')->nullable();
            $table->string('delivered_file')->nullable();
            $table->tinyInteger('pre_status')->default(0);
            $table->string('revision_description')->nullable();
            $table->tinyInteger('disputed_by')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->tinyInteger('emailed')->default(0);
            $table->tinyInteger('is_rated')->default(0);
            $table->json('dispute')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
