<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('health_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('test_type');
            $table->json('results');
            $table->json('test_data')->nullable(); // Added test_data field with nullable
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('health_assessments');
    }
};