<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('description');
            $table->float('price');
            $table->tinyInteger('status')->default(1);
            $table->string('review')->nullable();
            $table->dateTime("time_start")->nullable();
            $table->dateTime("time_end")->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('customer_id');
            $table->text('sensor')->nullable();
            $table->unsignedBigInteger('ward_id')->nullable();
            $table->foreign('ward_id')->references('xaid')->on('devvn_xaphuongthitran');
            $table->unsignedBigInteger('district_id')->nullable();
            $table->foreign('district_id')->references('maqh')->on('devvn_quanhuyen');
            $table->string('addressDetails')->nullable();
            $table->foreign("category_id")->references("id")->on("category");
            $table->foreign("employee_id")->references("id")->on("employee");
            $table->foreign("customer_id")->references("id")->on("customer");
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
        Schema::dropIfExists('post');
    }
}
