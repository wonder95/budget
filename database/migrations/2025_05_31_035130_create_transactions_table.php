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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')
                ->constrained('accounts')
                ->onDelete('cascade');
            $table->foreignId('pay_period')
                ->constrained('pay_periods')
                ->onDelete('cascade');
            $table->date('date');
            $table->decimal('amount', 10, 2);
            $table->enum('type', ['credit', 'deposit'])->default('deposit');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
