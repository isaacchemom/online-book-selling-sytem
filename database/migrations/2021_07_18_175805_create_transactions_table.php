<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            //$table->string('user_id');
            $table->string('phone');
            $table->string('email');
            $table->string('transaction_id');
            $table->integer('status')->default(0)->comment('0 is pending, 1 is completed');
           // $table->text('cart');
           $table->unsignedBigInteger('item_id');
            $table->timestamps();

            $table->foreign('item_id')
            ->references('id')
            ->on('items')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
