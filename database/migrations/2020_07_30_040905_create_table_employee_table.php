<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email');
            $table->string('avatar')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->string('phone');
            $table->string('password');
            $table->unsignedBigInteger('ward_id')->nullable();
            $table->foreign('ward_id')->references('xaid')->on('devvn_xaphuongthitran');
            $table->unsignedBigInteger('district_id')->nullable();
            $table->foreign('district_id')->references('maqh')->on('devvn_quanhuyen');
            $table->timestamps();
            $table->timestamp('banned_until')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee');
    }
}
