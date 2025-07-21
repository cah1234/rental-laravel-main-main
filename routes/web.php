<?php

use App\Http\Controllers\SukuCadangController;
use App\Http\Controllers\RekamDetailPartController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\UserController;
use App\Models\Pelanggan;
use App\Models\RekamMedis;
use app\Models\RekamDetailPart;
use Illuminate\Support\Facades\Route;


//Auth Admin//
Route::resource('hasil_kerja', RekamDetailPartController::class);

Route::get('/kendaraan-by-pelanggan/{pelanggan_id}', [RekamMedisController::class, 'getKendaraanByPelanggan'])
     ->name('rekammedis.kendaraan')
     ->middleware('auth');

// Route default
Route::get('/', function () {
    return view('welcome');
});

// Grouping route jika autentikasi digunakan
Route::middleware(['auth'])->group(function () {
    Route::resource('user', UserController::class);
});

// Jika menggunakan auth scaffolding seperti Laravel Breeze atau UI

// Redirect root ke dashboard
Route::get('/', fn() => redirect('/admin'));

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
Route::resource('rekam-detail', RekamDetailPartController::class);

// rekam detail part
Route::resource('rekam_detail_part', RekamDetailPartController::class);
Route::post('/rekam_detail_part', [RekamDetailPartController::class, 'store'])->name('rekam_detail_part.store');
Route::get('/rekam_detail_part', [RekamDetailPartController::class, 'index'])->name('rekam_detail_part.index');
Route::get('/rekam_detail_part/form/{order_id}', [RekamDetailPartController::class, 'form'])->name('rekam_detail_part.form');
Route::get('/rekam_detail_part/create', [RekamDetailPartController::class, 'create'])->name('rekam_detail_part.create');
Route::put('/rekam_detail_part/{id}', [RekamDetailPartController::class, 'update'])->name('rekam_detail_part.update');
Route::delete('/rekam_detail_part/{id}', [RekamDetailPartController::class, 'destroy'])->name('rekam_detail_part.destroy');
Route::get('/rekam_detail_part/create', [RekamDetailPartController::class, 'create'])->name('rekam_detail_part.create');
Route::post('/rekam_detail_part', [RekamDetailPartController::class, 'store'])->name('rekam_detail_part.store');

// =============================
// Fitur Suku Cadang
// =============================
Route::resource('suku_cadang', SukuCadangController::class)->middleware('auth');
Route::get('suku-cadang/{id}/edit', [SukuCadangController::class, 'edit'])->name('suku_cadang.edit');
Route::post('/pakai-suku-cadang', [RekamDetailPartController::class, 'pakaiSukuCadang'])->name('suku_cadang.pakai');

// =============================
// Fitur Pelanggan
// =============================
Route::resource('pelanggan', PelangganController::class)->middleware('auth');

// =============================
// Fitur Rekam Medis
// =============================
Route::resource('rekammedis', RekamMedisController::class);
Route::put('rekammedis/{id}/update-status', [RekamMedisController::class, 'updateStatus'])->name('rekammedis.updateStatus');
Route::resource('rekammedis', RekamMedisController::class)->middleware('auth');
// Contoh yang bisa menimbulkan masalah seperti parameter bernama "rekammedis" atau lainnya:
Route::resource('rekammedis', RekamMedisController::class)
->parameters(['rekammedis' => 'rekammedi']);
Route::get('rekammedis/{rekammedis}', [RekamMedisController::class, 'show'])->name('rekammedis.show');
Route::middleware('auth')->group(function () {
    Route::resource('rekammedis', RekamMedisController::class);
    // Hapus semua route lain yang menduplikasi resource ini
});


// =============================
// Fitur User (Gunakan plural 'users')
// =============================
Route::resource('users', UserController::class)->middleware('auth');
Route::resource('users', UserController::class);
Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

// =============================
// Auth (login/register)
// =============================
require __DIR__ . '/auth.php';
