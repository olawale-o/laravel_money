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
            $table->string('transaction_id')->nullable($value = false);
            $table->foreignId('sender_account_no')->constrained('accounts');
            $table->foreignId('receiver_account_no')->constrained('accounts');
            $table->decimal('previous_balance', $precision = 10, $scale = 2)->nullable($value = false);
            $table->decimal('current_balance', $precision = 10, $scale = 2)->nullable($value = false);
            $table->decimal('amount', $precision = 10, $scale = 2)->nullable($value = false);
            $table->decimal('charge')->nullable($value = false);
            $table->text('description')->nullable($value = false);
            $table->timestamp('created_at');
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
