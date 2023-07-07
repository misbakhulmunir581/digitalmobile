<?php

use App\Http\Controllers\IklanController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\TeknisiController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [UsersController::class, 'store']);
Route::post('/login', [UsersController::class, 'login']);

Route::post('/pesanan', [PesananController::class, 'store']);
Route::post('/konfirmasi', [PesananController::class, 'konfirmasi']);
Route::post('/bayardp', [PesananController::class, 'bayardp']);
Route::post('/konfirmasidp', [PesananController::class, 'konfirmasidp']);
Route::post('/pekerjaanselesai', [PesananController::class, 'pekerjaanselesai']);
Route::post('/revisi', [PesananController::class, 'revisi']);
Route::post('/revisi_selesai', [PesananController::class, 'revisi_selesai']);
Route::post('/selesaikan_project', [PesananController::class, 'selesaikan_project']);
Route::post('/selesaikanprojectadmin', [PesananController::class, 'selesaikanprojectadmin']);
Route::post('/konfirmasi_service', [PesananController::class, 'konfirmasi_service']);
Route::post('/jemput_pesanan', [PesananController::class, 'jemput_pesanan']);
Route::post('/kerjakan_service', [PesananController::class, 'kerjakan_service']);
Route::post('/pekerjaan_selesai', [PesananController::class, 'pekerjaan_selesai']);
Route::post('/antar_pesanan', [PesananController::class, 'antar_pesanan']);
Route::post('/selesaikan_service', [PesananController::class, 'selesaikan_service']);
Route::post('/batalkan_service', [PesananController::class, 'batalkan_service']);
Route::get('/pesanan_user', [PesananController::class, 'pesanan_user']);
Route::get('/pesanan_admin', [PesananController::class, 'pesanan_admin']);

Route::post('/teknisi', [TeknisiController::class, 'store']);
Route::get('/teknisi', [TeknisiController::class, 'index']);
Route::post('/teknisi_update', [TeknisiController::class, 'update']);
Route::post('/teknisi_delete', [TeknisiController::class, 'delete']);

Route::post('/iklan', [IklanController::class, 'store']);
Route::get('/iklan', [IklanController::class, 'index']);
Route::post('/iklan_update', [IklanController::class, 'update']);
Route::post('/iklan_delete', [IklanController::class, 'delete']);
