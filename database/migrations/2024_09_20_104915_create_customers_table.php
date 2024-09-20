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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('middle_name')->nullable();
            $table->string('first_name');
            $table->string('phone_number');
            $table->string('email')->nullable();
            $table->string('note')->nullable()->comment("used to add additional information about the customer");
            $table->date('birth_date')->nullable();
            $table->string('tax_code')->nullable()->comment("used to store information about customers who issue invoices");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
