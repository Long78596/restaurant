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
        Schema::create('purchase__invoice__details', function (Blueprint $table) {
            $table->id();
            $table->integer('food_id');
            $table->string('food_name');
            $table->double('input_quantity');
            $table->double('import_price');
            $table->double('total_amount');
            $table->integer('purchase_invoice_id');
            $table->text('note')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase__invoice__details');
    }
};
