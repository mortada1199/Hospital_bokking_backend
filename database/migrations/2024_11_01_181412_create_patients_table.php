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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('doctor');
            $table->string('specialization');
            $table->date('date');
            $table->string('email');
            $table->string('phone');
            $table->string('patientName');
            $table->string('address');
            $table->string('status')->default("null");
            $table->string('BeginOfPreview')->default("null");
            $table->string('endOfPreview')->default("null");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
