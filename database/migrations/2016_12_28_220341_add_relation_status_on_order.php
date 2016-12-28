<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationStatusOnOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->integer('status_id')->unsigned()->nullable();
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('status')->unsigned()->nullable();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('status_id');
        });
    }
}
