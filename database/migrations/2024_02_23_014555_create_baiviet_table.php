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
        Schema::create('baiviet', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->text('describe');
            $table->text('content');
            $table->text('image');
            $table->integer('views')->default(0);
            $table->string('status', 50)->nullable()->default('active');
            $table->unsignedBigInteger('chudeID');
            $table->dateTime('created')->nullable();
            $table->integer('created_by')->nullable();
            $table->dateTime('modified')->nullable();
            $table->integer('modified_by')->nullable();
             // Thiết lập foreign key
            $table->foreign('chudeID')->references('id')->on('chude')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baiviet');
    }
};
