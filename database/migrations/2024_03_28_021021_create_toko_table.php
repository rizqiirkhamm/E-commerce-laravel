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
        Schema::create('toko', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user')->unsigned();
            $table->string('nama_toko');
            $table->enum('kategori_toko',['elektronik','otomotif','sembako','fashion','makanan','obat','aksesoris','perabotan']);
            $table->timestamps();
            $table->text('desc_toko');
            $table->string('hari_buka');
            $table->string('hari_libur');
            $table->time('jam_libur');
            $table->time('jam_buka');
            $table->boolean('status_aktif')->default('0');
            $table->string('icon_toko')->default('default.png');
            $table->foreign('id_user')->on('users')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('toko');
    }
};
