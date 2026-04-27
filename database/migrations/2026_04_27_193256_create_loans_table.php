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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users'); // Afisa aliyepitisha mkopo
            $table->foreignId('loan_type_id')->constrained('loan_types');

            
            $table->decimal('principal_amount', 15, 2); 
            $table->decimal('interest_rate', 5, 2);
            $table->decimal('penalty_rate', 5, 2); 

           
            $table->decimal('processing_fee', 15, 2)->default(0); // Ada ya mkopo
            $table->decimal('form_fee', 15, 2)->default(0); // Hela ya fomu

            // Mahesabu ya Jumla
            $table->decimal('total_amount', 15, 2); // Principal + Total Interest
            $table->decimal('net_disbursed_amount', 15, 2); // Principal - Fees

            // Ratiba na Muda
            $table->enum('repayment_frequency', ['daily', 'weekly', 'monthly']);
            // badala ya ku rely on days pekee
            $table->integer('duration_days');
            $table->integer('number_of_installments');
            // Tarehe
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
      
            $table->foreignId('approved_by')->nullable()->constrained('users'); // Afisa aliyepitisha mkopo
            $table->timestamp('approved_at')->nullable(); // Tarehe ya kuidhin

            // Hali ya Mkopo
            $table->string('status')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
