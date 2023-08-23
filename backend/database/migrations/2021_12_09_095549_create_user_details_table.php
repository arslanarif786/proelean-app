<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->double('balance')->default(0);
            $table->foreignId('user_id')->constrained();
            $table->string('freelancer_title');
            $table->string('description');
            $table->string('availability');
            $table->string('lang');
            $table->foreignId('category_id')->nullable()->constrained();
            $table->foreignId('sub_category_id')->nullable()->constrained();
            $table->foreignId('country_id')->nullable()->constrained('countries');
            $table->string('cinic')->nullable();
            $table->tinyInteger('active')->default(0);
            $table->string('facebook')->nullable();
            $table->string('linked_in')->nullable();
            $table->string('portfolio')->nullable();
            $table->string('google_plus')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
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
        Schema::dropIfExists('user_details');
    }
}
