<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('gift_cards', function (Blueprint $table) {
            $table->id();
            $table->string('template')->default('template1.jpg'); // selected template image
            $table->string('recipient_name');
            $table->text('message');
            $table->string('sender_name');
            $table->string('font_style')->default('Poppins');
            $table->decimal('amount', 8, 2); // gift amount
            $table->string('delivery_method'); // Email or PDF
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gift_cards');
    }
};
