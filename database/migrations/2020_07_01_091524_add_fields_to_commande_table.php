<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToCommandeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->string('operator_transaction_ref')->nullable();
            $table->string('transaction_ref')->nullable();
            $table->string('transaction_type')->nullable();
            $table->string('transaction_amount')->nullable();
            $table->string('transaction_currency')->nullable();
            $table->string('transaction_status')->nullable();
            $table->string('transaction_reason')->nullable();
            $table->string('customer_phone_number')->nullable();
            $table->string('signature')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commandes', function (Blueprint $table) {
            //
        });
    }
}
