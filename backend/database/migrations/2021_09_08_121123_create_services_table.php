<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('sub_category_id')->constrained('sub_categories');
            $table->foreignId('category_id')->constrained();
            $table->string('s_description');
            $table->string('description');
            $table->string('slug')->nullable();
            $table->double('price');
            $table->string('delivery_time');
            $table->string('additional_info')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('featured')->default(0);
            $table->integer('rating')->default(0);
            $table->tinyInteger('revision')->default(0);
            $table->integer('total_reviews')->default(0);
            $table->integer('total_clicks')->default(0);
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
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
        Schema::dropIfExists('services');
    }
}
