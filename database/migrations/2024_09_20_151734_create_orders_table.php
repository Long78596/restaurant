<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('sales_invoice_code');
            $table->double('total_amount')->default(0);
            $table->double('discount')->default(0);
            $table->integer('table_id');
            $table->integer('customer_id')->default(0);
            $table->integer('status')->default(0)->comment('0: Active, 1: Invoice completed');
            $table->integer('payment_type_id')->default(0)->comment('0: Cash, others to be decided later');
            $table->integer('is_confirmed')->default(0);
            $table->dateTime('payment_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
