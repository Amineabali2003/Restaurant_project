<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfirmedOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('confirmed_orders', function (Blueprint $table) {
            // $table->id();
            $table->dropColumn('idUser');
            // $table->integer('idPlat');
            // $table->integer('Quantity');
            // $table->integer('idForm');

            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // public function down()
    // {
    //     Schema::dropIfExists('confirmed_orders');
    // }
}
