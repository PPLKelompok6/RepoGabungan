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
        Schema::create('e_prescriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->constrained()->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
            $table->text('medication_details'); // Detail obat dan dosis
            $table->text('instructions')->nullable(); // Instruksi penggunaan
            $table->text('notes')->nullable(); // Catatan tambahan
            $table->string('status')->default('active'); // Status resep (active/expired)
            $table->timestamp('valid_until')->nullable(); // Tanggal kadaluarsa resep
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e_prescriptions');
    }
};
