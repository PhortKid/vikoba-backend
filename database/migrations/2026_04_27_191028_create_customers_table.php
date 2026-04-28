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
            $table->id(); // PK
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
   
            $table->string('image')->nullable();
            $table->string('address')->nullable();
            //address
            $table->enum('gender', [
                'male', 
                'female', 
                'none', 
                
            ])->default('none');
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('national_id')->nullable()->unique();
            $table->enum('employment_type', [
                'government', 
                'private', 
                'student', 
                'business'
            ])->default('business');

            // Salary inaweza kuwa tupu (nullable) kwa wajasiriamali au wanafunzi
            $table->decimal('salary', 15, 2)->nullable(); 
            
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
