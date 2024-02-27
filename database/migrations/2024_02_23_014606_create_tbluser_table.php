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
        Schema::create('tbluser', function (Blueprint $table) {
            $table->unsignedInteger('IDUS')->autoIncrement();
            $table->string('TenUS', 100);
            $table->string('MatKhauUS', 200);
            $table->string('EmailUS', 50);
            $table->string('avatar')->nullable();
            $table->tinyInteger('TrangThaiUS');
            $table->string('status', 10)->default('0');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbluser');
    }
};
