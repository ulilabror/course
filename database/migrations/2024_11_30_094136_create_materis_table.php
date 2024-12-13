<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materis', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('content')->nullable();
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('created_by');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materis');
    }
};