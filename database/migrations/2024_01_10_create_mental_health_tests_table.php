<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mental_health_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('test_type');
            $table->integer('score');
            $table->integer('usia');  // Ubah dari 'age' ke 'usia' untuk konsistensi
            $table->string('gender');
            $table->string('domisili');
            $table->string('pekerjaan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mental_health_tests');
    }
};