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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->integer('food_id');
            $table->string('food_name');
            $table->double('quantity_sold');
            $table->double('sale_price');
            $table->double('discount_amount');
            $table->double('total_amount');
            $table->string('note')->nullable();
            $table->integer('is_prepared')->default(0);
            $table->integer('is_printed_to_kitchen')->default(0);
            $table->integer('preparation_time')->nullable();
            $table->integer('is_served')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
