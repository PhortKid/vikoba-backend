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
        Schema::create('loan_products', function (Blueprint $table) {
            $table->id();
            // Ownership
            $table->unsignedBigInteger('CompanyId');
            $table->unsignedBigInteger('BranchId')->nullable();
            // Identity
            $table->string('ProductCode', 20)->unique();
            $table->string('ProductName', 100);
            $table->string('ProductDescription', 255)->nullable();
            // Loan Limits
            $table->decimal('MinLoanAmount', 18, 2);
            $table->decimal('MaxLoanAmount', 18, 2);
            // Interest Configuration
            $table->decimal('InterestRate', 5, 2);
            $table->string('InterestType', 20); // Flat / Reducing
            // Tenure Rules
            $table->integer('MinTermDays');
            $table->integer('MaxTermDays');
            $table->string('RepaymentFrequency', 20); // Daily / Weekly / Monthly
            // Collateral Configuration
            $table->boolean('CollateralRequired')->default(false);
            $table->decimal('CollateralPercent', 5, 2)->default(0);
            // Status
            $table->boolean('Active')->default(true);
            $table->integer('CreatedBy');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_products');
    }
};
