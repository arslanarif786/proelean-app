<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username');
            $table->string('image')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('user_type')->default('user');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('isFreelancer');
            $table->json('stripe_account')->nullable();
            $table->double('latitude')->default(0);
            $table->double('longitude')->default(0);
            $table->string('city')->nullable();
            $table->string('description')->nullable();
            $table->string('postal_code')->nullable();
            $table->float('user_rating')->default(0);
            $table->double('available_balance')->default(0);
            $table->bigInteger('total_reviews')->default(0);
            $table->bigInteger('active_orders')->default(0);
            $table->bigInteger('total_clicks')->default(0);
            $table->tinyInteger('active')->default(0);
            $table->tinyInteger('bankaccount_verified')->default(0);
            $table->tinyInteger('verified')->default(0);
            $table->string('lang')->nullable();
            $table->string('currency_id')->nullable();
            $table->bigInteger('referal_code')->nullable();
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
