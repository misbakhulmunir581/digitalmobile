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
        // jenis jasa 
        // 0 = aplikasi
        // 1 = website
        // 2 = logo
        // 3 = Service Laptop

        // is status
        // 0 = menunggu konfirmasi admin 
        // 1 = menunggu konfirmasi pembayaran user
        // 2 = menunggu pengecekan pembayaran 
        // 3 = proses pengerjaan
        // 4 = Pekerjaan Selesai
        // 5 = revisi
        // 6 = selesai
        // 7 = Konfirmasi pembayaran, kirim file  dan project dinyatakan selesai 
        // 8 = batal

        //service
        // 0 = menunggu konfirmasi
        // 1 = menunggu penjemputan
        // 2 = Sedang dijemput
        // 3 = proses
        // 4 = Selesai Pengerjaan
        // 5 = menunggu pengantaran
        // 6 = selesai
        // 7 = batal
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('jenis_jasa');
            $table->integer('is_status')->default(0);
            $table->date('tanggal_deadline')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->date('tanggal_revisi')->nullable();
            $table->string('nama_brand')->nullable(); //aplikasi,website,logo
            $table->string('slogan')->nullable(); //aplikasi,website,logo
            $table->string('latar_belakang')->nullable(); //aplikasi,website,logo
            $table->string('psikologi')->nullable(); //logo
            $table->string('jenis')->nullable(); //aplikasi,website,logo,komputer
            $table->string('warna')->nullable(); //aplikasi,website,logo
            $table->string('kata_kunci')->nullable(); //logo
            $table->string('deskripsi')->nullable(); //aplikasi,website,komputer
            $table->string('link_whimsical')->nullable(); //aplikasi,website
            $table->string('link_youtube')->nullable(); //aplikasi,website,komputer
            $table->string('keterangan')->nullable(); //aplikasi,website,komputer,logo  //diisi ketika selesai mengerjakan
            $table->string('alamat_penjemputan')->nullable(); //Komputer
            $table->string('alamat_pengiriman')->nullable(); //Komputer
            $table->date('tanggal_garansi')->nullable(); //Komputer
            $table->integer('pembayaran_dp')->nullable(); //Aplikasi,Komputer,Website,Logo
            $table->integer('pembayaran_sisa')->nullable(); //Aplikasi,Komputer,Website,Logo
            $table->integer('pembayaran_total')->nullable(); //Aplikasi,Komputer,Website,Logo
            $table->string('bukti_dp')->nullable(); //Aplikasi,Komputer,Website,Logo
            $table->string('bukti_sisa')->nullable(); //Aplikasi,Komputer,Website,Logo
            $table->string('bukti_total')->nullable(); //Aplikasi,Komputer,Website,Logo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};


// Form Logo
// 1. email 
// 2. nomor 
// 3. nama anda
// 4. nama brand 
// 5. slogan 
// 6. latar belakang brand
// 7. psikologi bentuk
// 8. jenis logo
// 9. warna
// 10. kata kunci (semangat,muda,energik,dll)