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
        Schema::create('admin', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('password', 200);
            $table->string('fullName', 200);
            $table->string('email', 50);
            $table->unsignedBigInteger('roleID');
            $table->string('status', 50)->nullable();
            $table->dateTime('created')->nullable();
            $table->integer('created_by')->nullable();
            $table->dateTime('modified')->nullable();
            $table->integer('modified_by')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
