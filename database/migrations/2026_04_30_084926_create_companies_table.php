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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('CompanyName', 150);
            $table->string('CompanyShortCode', 3);
            $table->string('RegistrationNumber', 50)->nullable(); // BRELA
            $table->string('LicenseNumber', 50)->nullable(); // BOT License
            $table->string('TIN', 50)->nullable(); // Tax Identification Number
            $table->string('Address', 200)->nullable();
            $table->string('Region', 100)->nullable();
            $table->string('District', 100)->nullable();
            $table->string('Phone', 50)->nullable();
            $table->string('Email', 100)->nullable();
            // Financial Info
            $table->string('BaseCurrency', 10)->default('TZS');
            $table->decimal('MinimumLoanAmount', 18, 2)->nullable();
            $table->decimal('MaximumLoanAmount', 18, 2)->nullable();
            $table->decimal('InterestRate', 5, 2)->nullable(); // standard rate
            $table->decimal('PenaltyRate', 5, 2)->nullable();
            // Compliance & Risk
            $table->decimal('HighRiskLevel', 18, 2)->nullable();
            $table->decimal('MediumRiskLevel', 18, 2)->nullable();
            $table->decimal('LowRiskLevel', 18, 2)->nullable();
            $table->boolean('KYCRequired')->default(true);
            $table->boolean('AMLPolicyEnabled')->default(true);
            $table->decimal('AMLPolicyMaxAmount', 18, 2)->nullable();
            $table->text('AgreementCompanyPolicy')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
