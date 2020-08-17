<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email');
            $table->string('avatar')->nullable();
            $table->boolean('is_active')->default(0)->nullable();
            $table->string('password');
            $table->string('phone');
            $table->unsignedBigInteger('ward_id')->nullable();
            $table->foreign('ward_id')->references('xaid')->on('devvn_xaphuongthitran');
            $table->unsignedBigInteger('district_id')->nullable();
            $table->foreign('district_id')->references('maqh')->on('devvn_quanhuyen');
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
        Schema::dropIfExists('customer');
    }
}
