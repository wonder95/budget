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
        Schema::create('paychecks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pay_period_id')
                ->constrained('pay_periods')
                ->onDelete('cascade');
            $table->foreignId('employer_id')
                ->constrained('employers')
                ->onDelete('cascade');
            $table->date('date');
            $table->decimal('amount', 10, 2)->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paychecks');
    }
};
