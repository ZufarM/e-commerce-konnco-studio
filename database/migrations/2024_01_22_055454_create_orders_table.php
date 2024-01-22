<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('user_id');
            $table->string('delivery_address');
            $table->integer('sub_total'); // nilai total dari item yang dipesan (tidak termasuk delivery fee)
            $table->integer('delivery_fee'); // nilai ongkos kirim
            $table->integer('total'); // subtotal + delivery_fee
            $table->enum('order_status', [
                'waiting_payment',
                'processing',
                'in_delivery',
                'delivered'
            ]);
            $table->enum('payment_status', [
                'waiting_payment',
                'paid'
            ]);
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
        Schema::dropIfExists('orders');
    }
}
