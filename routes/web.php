<?php

use App\Livewire\Manajemen\Anggota\Index;
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
        Route::view('/pinjaman/pribadi', 'manajemen.pinjaman.pribadi')->name('pinjaman.pribadi');
        Route::view('/anggota', 'manajemen.anggota.index')->name('anggota.index');
        Route::view('/anggota/total', 'manajemen.anggota.total')->name('anggota.total');
        Route::view('/anggota/disetujui', 'manajemen.anggota.disetujui')->name('anggota.disetujui');
        Route::view('/anggota/disetujui/{id}', 'manajemen.anggota.detail-anggota-disetujui')->name('anggota.detail-anggota-disetujui');
        Route::view('/anggota/menunggu', 'manajemen.anggota.menunggu')->name('anggota.menunggu');
        Route::view('/anggota/menunggu/{id}', 'manajemen.anggota.detail-anggota-menunggu')->name('anggota.detail-anggota-menunggu');
        Route::view('/rekap', 'manajemen.rekap.index')->name('rekap.index');
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
        Route::view('/pinjaman', 'pengawas.pinjaman.index')->name('pinjaman.index');
        Route::get('/anggota', Index::class)->name('anggota.index');
        Route::view('/rekap', 'pengawas.rekap.index')->name('rekap.index');
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
        Route::view('/pinjaman', 'anggota.pinjaman.index')->name('pinjaman.index');
        Route::view('/profile', 'anggota.profile.index')->name('profile.index')->middleware('auth');
    });
