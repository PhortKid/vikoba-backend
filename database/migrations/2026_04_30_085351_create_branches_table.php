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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('CompanyId')->nullable();
            // Identity
            $table->string('BranchCode', 20)->unique();
            $table->string('BranchName', 100);
            // Location
            $table->string('Region', 100)->nullable();
            $table->string('District', 100)->nullable();
            $table->string('Ward', 100)->nullable();
            $table->string('Street', 100)->nullable();
            $table->string('PhysicalAddress', 200)->nullable();
            $table->decimal('Longitude', 10, 7)->nullable();
            $table->decimal('Latitude', 10, 7)->nullable();
            // Contact
            $table->string('Phone', 50)->nullable();
            $table->string('Email', 100)->nullable();
            // Loan Limits & Operations
            $table->decimal('MinLoanAmountAllowed', 18, 2)->default(0);
            $table->decimal('MaxLoanAmountAllowed', 18, 2)->nullable();
            $table->decimal('MaxLoanApprovalLimit', 18, 2)->nullable();
            $table->decimal('DailyLoanDisbursementLimit', 18, 2)->nullable();
            $table->decimal('DailyCollectionTarget', 18, 2)->nullable();
            $table->decimal('CashHoldingLimit', 18, 2)->nullable();
            $table->boolean('Active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
