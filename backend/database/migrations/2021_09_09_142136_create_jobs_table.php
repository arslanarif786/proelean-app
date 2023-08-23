<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('sub_category_id')->constrained('sub_categories');
            $table->string('description');
            $table->string('slug')->nullable();
            $table->tinyInteger('offers')->default(0);
            $table->double('budget');
            $table->string('delivery_time');
            $table->string('cinic')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('active')->default(1);
            $table->tinyInteger('featured')->default(0);
            $table->timestamp('apply_before')->nullable();
            $table->string('min_qualification')->nullable();
            $table->string('max_salary')->nullable();
            $table->string('min_salary')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
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
        Schema::dropIfExists('jobs');
    }
}
