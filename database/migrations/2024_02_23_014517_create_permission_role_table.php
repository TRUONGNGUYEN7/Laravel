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
        Schema::create('permission_role', function (Blueprint $table) {
            $table->unsignedBigInteger('roleID');
            $table->unsignedBigInteger('permissionID');
            $table->foreign('roleID')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('permissionID')->references('id')->on('permissions')->onDelete('cascade');
            $table->primary(['roleID', 'permissionID']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_role');
    }
};
