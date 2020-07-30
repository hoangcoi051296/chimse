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
            $table->string('status');
            $table->string('description');
            $table->float('price');
            $table->string('address');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('helper_id');
            $table->unsignedBigInteger('customer_id');
            $table->foreign("category_id")->references("id")->on("category");
            $table->foreign("helper_id")->references("id")->on("helper");
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
