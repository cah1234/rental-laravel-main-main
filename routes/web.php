<?php
use App\Http\Controllers\SukuCadangController;
use App\Http\Controllers\HasilPekerjaanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\UserController;
use App\Models\Pelanggan;
use App\Models\RekamMedis;
use Illuminate\Support\Facades\Route;




Route::resource('suku_cadang', SukuCadangController::class)->middleware('auth');

// Redirect root ke dashboard
Route::get('/', fn() => redirect('/admin'));

Route::resource('suku_cadang', SukuCadangController::class);


// Dashboard
Route::get('/admin', function () {
    $total_pelanggan = Pelanggan::count();
    $total_rekam_medis = RekamMedis::count();
    $total_servis_selesai = RekamMedis::where('status_servis', 'Selesai')->count();

    return view('pages.dashboard', compact(
        'total_pelanggan',
        'total_rekam_medis',
        'total_servis_selesai',
    ));
})->middleware('auth')->name('dashboard');

// =============================
// Fitur Hasil Pekerjaan
// =============================
Route::get('/hasil_kerja', [HasilPekerjaanController::class, 'index'])->name('hasil_kerja.index');
Route::get('/hasil_kerja/form/{order_id}', [HasilPekerjaanController::class, 'form'])->name('hasil_kerja.form');
Route::get('/hasil_kerja/{id}/edit', [HasilPekerjaanController::class, 'edit'])->name('hasil_kerja.edit');
Route::put('/hasil_kerja/{id}', [HasilPekerjaanController::class, 'update'])->name('hasil_kerja.update');
Route::delete('/hasil_kerja/{id}', [HasilPekerjaanController::class, 'destroy'])->name('hasil_kerja.destroy');

// =============================
// Fitur Suku Cadang
// =============================
Route::resource('suku_cadang', SukuCadangController::class)->middleware('auth');
Route::resource('suku_cadang', SukuCadangController::class);

// =============================
// Fitur Pelanggan
// =============================
Route::resource('pelanggan', PelangganController::class)->middleware('auth');

// =============================
// Fitur Rekam Medis & User
// =============================
Route::resource('rekammedis', RekamMedisController::class)->middleware('auth');
Route::resource('user', UserController::class)->middleware('auth');

// Auth (login/register)
require __DIR__ . '/auth.php';
