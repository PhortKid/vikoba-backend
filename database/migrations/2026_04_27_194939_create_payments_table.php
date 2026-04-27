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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_id')->constrained('loans')->onDelete('cascade');
            $table->foreignId('schedule_id')
          ->nullable()
          ->constrained('loan_schedules')
          ->onDelete('set null');
            $table->decimal('principal_paid', 15, 2);
            $table->decimal('interest_paid', 15, 2)->default(0);
             $table->decimal('penalty_paid', 15, 2)->default(0);
            // optional (for quick total)
            $table->decimal('total_paid', 15, 2);
            $table->enum('payment_method', ['cash', 'mobile_money', 'bank'])
                ->default('cash');
            $table->string('reference_no')->nullable()->unique();
            $table->foreignId('received_by')->constrained('users');// Afisa aliyepokea malipo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
