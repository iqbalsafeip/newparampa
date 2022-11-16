<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataMarketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_markets', function (Blueprint $table) {
            $table->id();
            $table->string("nama_permohonan");
            $table->string("nama_perusahaan");
            $table->string("alamat");
            $table->string("nomor_izin");
            $table->string("tanggal_izin");
            $table->string("tipe_market");
            $table->string("id_kecamatan");
            $table->string("longitude");
            $table->string("latitude");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_markets');
    }
}
