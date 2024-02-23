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
        Schema::create('tbldanhmuc', function (Blueprint $table) {
            $table->unsignedInteger('IDDM')->autoIncrement();
            $table->string('TenDanhMuc', 200);
            $table->tinyInteger('TrangThaiDM');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbldanhmuc');
    }
    
};
