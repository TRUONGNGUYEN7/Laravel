<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('danhmuc', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('status', 50)->nullable();
            $table->dateTime('created')->nullable();
            $table->integer('created_by')->nullable();
            $table->dateTime('modified')->nullable();
            $table->integer('modified_by')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('danhmuc');
    }
    
};
