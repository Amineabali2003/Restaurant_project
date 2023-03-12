<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_orders', function (Blueprint $table) {

            $table->id();
            $table->string('idUser');
            $table->string('Fullname');
            $table->string('Phone');
            $table->string('Address');
            $table->string('City');
            $table->integer('Zip');
            $table->integer('totalOrder');
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
        Schema::dropIfExists('form_orders');
    }
}
