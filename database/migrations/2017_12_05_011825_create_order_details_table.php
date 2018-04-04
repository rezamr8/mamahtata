<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('product_id');
            $table->float('panjang');
            $table->float('lebar');
            $table->float('luas');
            $table->double('harga');
            $table->double('discount')->nullable();
            $table->integer('jumlah');
            $table->double('sub_total');
            $table->double('biaya_setting');           
            $table->string('keterangan')->nullable();
            $table->double('keuntungan');
            $table->timestamps();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
