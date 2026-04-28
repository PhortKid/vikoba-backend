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
        Schema::create('loan_guarantor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_id')->constrained('loans')->onDelete('cascade');
            $table->foreignId('guarantor_id')->constrained('guarantors')->onDelete('cascade');
            // Maelezo ya udhamini kwenye mkopo huu mahususi
            $table->string('relationship'); // rafiki, ndugu, mfanyakazi mwenzake
            $table->decimal('guarantee_amount', 15, 2)->nullable(); // Kiasi anachodhamini
            // Hali ya udhamini
            $table->enum('status', ['active', 'released'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_guarantor');
    }
};
