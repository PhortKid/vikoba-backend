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
        Schema::create('loan_product_fees', function (Blueprint $table) {
            $table->id();
            // Relationship
            $table->unsignedBigInteger('LoanProductId');
            // Fee definition
            $table->string('FeeType', 50);
            // ProcessingFee / InsuranceFee / LatePenalty / Other
            $table->string('CalculationType', 20);
            // Flat / Percentage
            $table->decimal('Value', 18, 2);
            $table->string('ApplyOn', 20)->nullable();
            // Principal / Installment / OutstandingBalance
            $table->string('Frequency', 20)->nullable();
            // OneTime / PerInstallment / Daily / Monthly
            $table->boolean('IsMandatory')->default(true);
            $table->boolean('IsActive')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_product_fees');
    }
};
