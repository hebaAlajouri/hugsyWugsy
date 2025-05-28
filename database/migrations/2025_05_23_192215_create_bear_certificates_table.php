<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bear_certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('owner_name');
            $table->string('bear_name');
            $table->date('adoption_date');
            $table->string('certificate_number')->unique();
            $table->boolean('is_active')->default(true); // Allow users to have multiple bears
            $table->timestamps();
            
            // Add indexes for better performance
            $table->index(['user_id', 'is_active']);
            $table->index(['owner_name', 'bear_name']);
            $table->index('adoption_date');
            $table->index('certificate_number');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bear_certificates');
    }
};