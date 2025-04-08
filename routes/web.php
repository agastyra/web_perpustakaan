<?php

use App\Http\Controllers\PenerbitController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\RakController;
use App\Http\Controllers\PeminjamanController;
// use App\Http\Controllers\PenerbitController;
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

Route::get('/', function () {
    return view('helloworld');
});

Route::get('/boostrap', function () {
    return view('boostrap');
});

Route::get('/login', [PagesController::class, 'loginPage'])->name('login');
Route::post('/login', [PagesController::class, 'authenticate'])->name('login.post');
Route::delete('/logout', [PagesController::class, 'logout'])->name('logout');
Route::get('/register', [PagesController::class, 'registerPage'])->name('register');
Route::post('/register', [PagesController::class, 'register'])->name("register.post");

Route::middleware(['auth', 'role'])->group(function () {
    Route::get('/siswa', [PagesController::class, 'dashboardSiswa'])->name('siswa');
    Route::get('/siswaBuku', [PagesController::class, 'siswaBuku'])->name('siswaBuku');
    Route::get('/siswaPeminjaman', [PagesController::class, 'siswaPeminjaman'])->name('siswaPeminjaman');
    Route::get('/siswacreatePeminjaman', [PagesController::class, 'siswacreatePeminjaman'])->name('siswacreatePeminjaman');
    Route::post("/peminjaman", [PeminjamanController::class, 'store'])->name('peminjaman.post');
    Route::get('/pengaturan', [PagesController::class, 'pengaturan'])->name('pengaturan');
    Route::get('/siswapeminjamandetail', [PagesController::class, 'siswapeminjamandetail'])->name('siswapeminjamandetail');
    Route::put('/siswaPengaturan/update/{id}' , [PagesController::class, 'updateSiswaPengaturan'])->name('updateSiswaPengaturan');
    Route::patch('user/{id}/update_profile', [PagesController::class, 'upload_profile'])->name('action.upload_profile');

    Route::middleware('admin')->group(function () {
        Route::get('/admin', [PagesController::class, 'dashboardAdmin'])->name('admin');
        Route::get('/adminBuku', [PagesController::class, 'adminBuku'])->name('adminBuku');
        Route::get('/createBuku', [PagesController::class, 'createBuku'])->name('createBuku');
        Route::get('/updateBuku', [PagesController::class, 'updateBuku'])->name('updateBuku');
        Route::get('/kategoriBuku', [PagesController::class, 'kategoriBuku'])->name('kategoriBuku');
        Route::get('/createkategoriBuku', [PagesController::class, 'createkategoriBuku'])->name('createkategoriBuku');
        Route::get('/kategoriupdateBuku', [PagesController::class, 'kategoriupdateBuku'])->name('kategoriupdateBuku');
        Route::get('/penulis', [PagesController::class, 'penulis'])->name('penulis');
        Route::get('/createPenulis', [PagesController::class, 'createPenulis'])->name('createPenulis');
        Route::get('/updatePenulis', [PagesController::class, 'updatePenulis'])->name('updatePenulis');
        Route::get('/penerbit', [PagesController::class, 'penerbit'])->name('penerbit');
        // Route::get('/createPenerbit', [PagesController::class, 'createPenerbit'])->name('createPenerbit');
        Route::get('/updatePenerbit', [PagesController::class, 'updatePenerbit'])->name('updatePenerbit');
        Route::get('/penerbit', [PagesController::class, 'penerbit'])->name('penerbit');
        Route::get('/adminPeminjaman', [PagesController::class, 'adminPeminjaman'])->name('adminPeminjaman');
        Route::get('/adminupdatePeminjaman/{id}', [PagesController::class, 'adminupdatePeminjaman'])->name('adminupdatePeminjaman');
//        Route::get('/adminPengaturan', [PagesController::class, 'adminPengaturan'])->name('adminPengaturan');


        //penerbit
        Route::get('/penerbit/create', [PenerbitController::class, 'showCreateForm'])->name('penerbit.create');
        Route::post('/penerbit/store', [PenerbitController::class, 'store'])->name('penerbit.store');
        Route::get('/penerbit', [PenerbitController::class, 'readpenerbit'])->name('penerbit');
        Route::get('/update_penerbit/{penerbit_id}', [PagesController::class, 'update_penerbit'])->name('update_penerbit');

        Route::get('/penerbit/edit/{id}', [PenerbitController::class, 'edit'])->name('penerbit.edit');
        Route::post('/penerbit/update/{id}', [PenerbitController::class, 'update'])->name('penerbit.update');
        Route::get('/penerbit/edit/{id}', [PenerbitController::class, 'edit'])->name('penerbit.edit');
        Route::delete('/penerbit/delete/{id}', [PenerbitController::class, 'destroy'])->name('penerbit.delete');

        //rak
        Route::get('/adminRak', [PagesController::class, 'adminRak'])->name('adminRak');
        Route::get('/admincreateRak', [PagesController::class, 'admincreateRak'])->name('admincreateRak');
        Route::get('/adminupdateRak', [PagesController::class, 'adminupdateRak'])->name('adminupdateRak');
        Route::get('/adminRak', [RakController::class, 'readRak'])->name('rak');
        Route::get('/admincreateRak', [RakController::class, 'showCreateForm']);
        Route::post('/adminstoreRak', [RakController::class, 'store'])->name('storeRak');
        Route::get('/adminupdateRak/{id}', [RakController::class, 'edit'])->name('editRak');
        Route::post('/adminupdateRak/{id}', [RakController::class, 'update'])->name('updateRak');
        Route::get('/admindeleteRak/{id}', [RakController::class, 'destroy'])->name('deleteRak');


        //detail peminjaman
        Route::get('/adminpeminjamandetail', [PagesController::class, 'adminpeminjamandetail'])->name('adminpeminjamandetail');

        // Peminjaman
        Route::put("/peminjaman/update/{id}", [PeminjamanController::class, 'update'])->name('peminjaman.update');
        Route::delete("/peminjaman/delete/{id}", [PeminjamanController::class, "delete"])->name("peminjaman.delete");

        //buku
        // Route::get('/buku', [BukuController::class, 'readBuku'])->name(name: 'buku');
        Route::get('/buku/create', [BukuController::class, 'showCreateForm'])->name('buku.create');
        Route::post('/buku/store', [BukuController::class, 'store'])->name('buku.store');
        Route::get('/buku/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit');
        Route::post('/buku/update/{id}', [BukuController::class, 'update'])->name('buku.post');
        Route::get('/buku/delete/{id}', [BukuController::class, 'destroy'])->name('buku.delete');
        Route::get('/buku', [BukuController::class, 'index'])->name(name: 'buku.index');
        Route::get('/buku/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit');
        Route::patch('/buku/update/{id}', [BukuController::class, 'update'])->name('buku.update');

        //penulis
        Route::get('/penulis', [PenulisController::class, 'readpenulis'])->name('penulis');
        Route::get('/createPenulis', [PenulisController::class, 'showCreateForm']);
        Route::post('/storePenulis', [PenulisController::class, 'store']);
        Route::get('/editPenulis/{id}', [PenulisController::class, 'edit']);
        Route::post('/updatePenulis/{id}', [PenulisController::class, 'update']);
        Route::get('/deletePenulis/{id}', [PenulisController::class, 'destroy']);

        //kategori
        Route::get('/kategoriBuku', [KategoriController::class, 'readkategori'])->name('kategori');
        Route::get('/createkategoriBuku', [KategoriController::class, 'showCreateForm']);
        Route::post('/storekategoriBuku', [KategoriController::class, 'store']);
        Route::get('/editkategoriBuku/{id}', [KategoriController::class, 'edit']);
        Route::post('/updatekategoriBuku/{id}', [KategoriController::class, 'update']);
        Route::get('/deletekategoriBuku/{id}', [KategoriController::class, 'destroy']);
    });
});
