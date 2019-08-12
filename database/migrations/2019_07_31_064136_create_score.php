<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score_tables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rank')->default(0);
            $table->integer('pre_rank')->default(0);
            $table->integer('week_rank')->default(0);
            $table->integer('week_pre_rank')->default(0);
            $table->integer('month_rank')->default(0);
            $table->integer('month_pre_rank')->default(0);
            $table->integer('user_id')->default(0);
            $table->integer('points')->default(0);
            $table->integer('week_points')->default(0);
            $table->integer('month_points')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('score_table');
    }
}
