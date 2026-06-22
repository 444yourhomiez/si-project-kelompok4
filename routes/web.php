<?php
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\LaporanController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::view('/', 'homepage')->name('homepage');
// ======================
// RESGISTER
// ======================
Route::get('/register', function () {
    if (auth()->check() && auth()->user()->role == 'anggota') {
        return redirect()->route('menunggu');
    }
    return view('auth.register-wizard');
})->name('register');
Route::view('/menunggu', 'auth.menunggu')
    ->middleware(['auth', 'role:anggota'])
    ->name('menunggu');
// ======================
// LOGIN
// ======================
Route::view('/login', 'auth.login')->name('login');
// ======================
// FORGOT / RESET PASSWORD
// ======================
Route::view('/forgot-password', 'auth.forgot-password')
    ->middleware('guest')
    ->name('password.request');
Route::get('/reset-password/{token}', function (string $token) {
    if (auth()->check()) {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }
    return view('auth.reset-password', ['token' => $token]);
})->name('password.reset');
// ======================
// EMAIL VERIFICATION
// ======================
Route::get('/email/verify', function () {
    return redirect()->route('menunggu');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');
Route::post('/email/verification-notification', function () {
    /** @var \App\Models\User|null $user */
    $user = auth()->user();
    $user?->sendEmailVerificationNotification();
    return back()->with('info', 'Link verifikasi dikirim ulang.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
// ======================
// VERIFIKASI OTP HP
// ======================
Route::get('/verifikasi-hp', function () {
    return view('auth.verifikasi-otp-hp');
})->middleware('auth')->name('verifikasi-otp-hp');
// ======================
// LOGOUT
// ======================
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('homepage');
})->name('logout');
// ======================
// MANAJEMEN
// ======================
Route::middleware(['auth', 'role:manajemen'])
    ->prefix('manajemen')
    ->name('manajemen.')
    ->group(function () {
        Route::view('/dashboard', 'manajemen.dashboard')->name('dashboard');
        Route::view('/simpanan', 'manajemen.simpanan.index')->name('simpanan.index');
        Route::view('/simpanan/pokok', 'manajemen.simpanan.pokok')->name('simpanan.pokok');
        Route::view('/simpanan/sukarela', 'manajemen.simpanan.sukarela')->name('simpanan.sukarela');
        Route::view('/simpanan/wajib', 'manajemen.simpanan.wajib')->name('simpanan.wajib');
        Route::view('/pinjaman', 'manajemen.pinjaman.index')->name('pinjaman.index');
        Route::view('/pinjaman/khusus', 'manajemen.pinjaman.khusus')->name('pinjaman.khusus');
        Route::view('/pinjaman/biasa', 'manajemen.pinjaman.biasa')->name('pinjaman.biasa');
        Route::view('/cicilan', 'manajemen.cicilan.index')->name('cicilan.index');
        Route::view('/cicilan/khusus', 'manajemen.cicilan.khusus')->name('cicilan.khusus');
        Route::view('/cicilan/biasa', 'manajemen.cicilan.biasa')->name('cicilan.biasa');
        Route::view('/anggota', 'manajemen.anggota.index')->name('anggota.index');
        Route::view('/anggota/disetujui', 'manajemen.anggota.disetujui')->name('anggota.disetujui');
        Route::view('/anggota/disetujui/{id}', 'manajemen.anggota.detail-anggota-disetujui')->name('anggota.detail-anggota-disetujui');
        Route::view('/anggota/menunggu', 'manajemen.anggota.menunggu')->name('anggota.menunggu');
        Route::view('/anggota/menunggu/{id}', 'manajemen.anggota.detail-anggota-menunggu')->name('anggota.detail-anggota-menunggu');
        Route::view('/rekap', 'manajemen.rekap.index')->name('rekap.index');
        Route::view('/rekap/dum', 'manajemen.rekap.dum')->name('rekap.dum');
        Route::view('/rekap/duk', 'manajemen.rekap.duk')->name('rekap.duk');
        Route::view('/laporan', 'manajemen.laporan.index')->name('laporan.index');
        Route::view('/profile', 'manajemen.profile.index')->name('profile.index')->middleware('auth');
    });
// ======================
// PENGAWAS
// ======================
Route::middleware(['auth', 'role:pengawas'])
    ->prefix('pengawas')
    ->name('pengawas.')
    ->group(function () {
        Route::view('/dashboard', 'pengawas.dashboard')->name('dashboard');
        Route::view('/simpanan', 'pengawas.simpanan.index')->name('simpanan.index');
        Route::view('/simpanan/pokok', 'pengawas.simpanan.pokok')->name('simpanan.pokok');
        Route::view('/simpanan/sukarela', 'pengawas.simpanan.sukarela')->name('simpanan.sukarela');
        Route::view('/simpanan/wajib', 'pengawas.simpanan.wajib')->name('simpanan.wajib');
        Route::view('/pinjaman', 'pengawas.pinjaman.index')->name('pinjaman.index');
        Route::view('/pinjaman/khusus', 'pengawas.pinjaman.khusus')->name('pinjaman.khusus');
        Route::view('/pinjaman/biasa', 'pengawas.pinjaman.biasa')->name('pinjaman.biasa');
        Route::view('/cicilan', 'pengawas.cicilan.index')->name('cicilan.index');
        Route::view('/cicilan/khusus', 'pengawas.cicilan.khusus')->name('cicilan.khusus');
        Route::view('/cicilan/biasa', 'pengawas.cicilan.biasa')->name('cicilan.biasa');
        Route::view('/anggota', 'pengawas.anggota.index')->name('anggota.index');
        Route::view('/anggota/disetujui', 'pengawas.anggota.disetujui')->name('anggota.disetujui');
        Route::view('/anggota/disetujui/{id}', 'pengawas.anggota.detail-anggota-disetujui')->name('anggota.detail-anggota-disetujui');
        Route::view('/anggota/menunggu', 'pengawas.anggota.menunggu')->name('anggota.menunggu');
        Route::view('/anggota/menunggu/{id}', 'pengawas.anggota.detail-anggota-menunggu')->name('anggota.detail-anggota-menunggu');
        Route::view('/rekap', 'pengawas.rekap.index')->name('rekap.index');
        Route::view('/rekap/dum', 'pengawas.rekap.dum')->name('rekap.dum');
        Route::view('/rekap/duk', 'pengawas.rekap.duk')->name('rekap.duk');
        Route::view('/laporan', 'pengawas.laporan.index')->name('laporan.index');
        Route::view('/profile', 'pengawas.profile.index')->name('profile.index')->middleware('auth');
    });
// ======================
// ANGGOTA
// ======================
Route::middleware(['auth', 'role:anggota'])
    ->prefix('anggota')
    ->name('anggota.')
    ->group(function () {
        Route::view('/dashboard', 'anggota.dashboard')->name('dashboard');
        Route::view('/simpanan', 'anggota.simpanan.index')->name('simpanan.index');
        Route::view('/simpanan/pokok', 'anggota.simpanan.pokok')->name('simpanan.pokok');
        Route::view('/simpanan/sukarela', 'anggota.simpanan.sukarela')->name('simpanan.sukarela');
        Route::view('/simpanan/wajib', 'anggota.simpanan.wajib')->name('simpanan.wajib');
        Route::view('/pinjaman', 'anggota.pinjaman.index')->name('pinjaman.index');
        Route::view('/pinjaman/biasa', 'anggota.pinjaman.biasa')->name('pinjaman.biasa');
        Route::view('/pinjaman/khusus', 'anggota.pinjaman.khusus')->name('pinjaman.khusus');
        Route::view('/cicilan', 'anggota.cicilan.index')->name('cicilan.index');
        Route::view('/cicilan/biasa', 'anggota.cicilan.biasa')->name('cicilan.biasa');
        Route::view('/cicilan/khusus', 'anggota.cicilan.khusus')->name('cicilan.khusus');
        Route::view('/profile', 'anggota.profile.index')->name('profile.index')->middleware('auth');
    });

// ======================
// PENCETAKAN
// ======================

Route::get(
    '/laporan/pdf',
    [LaporanController::class, 'pdf']
)->name('laporan.pdf');

Route::get(
    '/laporan/excel',
    [LaporanController::class, 'excel']
)->name('laporan.excel');

Route::get(
    '/shu/pdf',
    [LaporanController::class, 'shuPdf']
)->middleware(['auth'])->name('shu.pdf');

Route::get(
    '/shu/excel',
    [LaporanController::class, 'shuExcel']
)->middleware(['auth'])->name('shu.excel');
