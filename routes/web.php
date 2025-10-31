<?php

use App\Http\Controllers\MyController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RelasiController;

// controller harus di import / di panggil

Route::get('/', function () {
    return view('welcome');
});

// basic
Route::get('about', function () {
    return '<h1>Hallo </h1>' .
        '<br>Selamat Datang di Perpustakaan Digital';
});

Route::get('buku', function () {
    return view('buku');
});

Route::get('menu', function () {
    // multi data / array
    $data = [
        ['nama_makanan' => 'Bala-bala', 'harga' => 1000, 'jumlah' => 10],
        ['nama_makanan' => 'Gehu Pedas', 'harga' => 2000, 'jumlah' => 15],
        ['nama_makanan' => 'Cireng Isi Ayam', 'harga' => 2500, 'jumlah' => 5],
    ];
    // single data
    $resto = "Resto MPL - Makanan Penuh Lemak";
    // compact fungisnya untuk mengirim collection data(array)
    // yang ada di variabel ke dalam sebuah view
    return view('menu', compact('data', 'resto'));
});

// route Parameter (Nilai)
Route::get('books/{judul}', function ($a) {
    return 'Judul Buku : ' . $a;
});

// Route::get('post/{title}/{category}', function ($a, $b) {
//     // compact assosiatif
//     return view('post', ['judul' => $a, 'cat' => $b]);
// });

// Route Optional Parameter
// ditandai dengan ?
Route::get('profile/{nama?}', function ($a = "guest") {
    return 'Halo saya ' . $a;
});

Route::get('order/{item?}', function ($a = "Nasi") {
    return view('order', compact('a'));
});

// Test Model
Route::get('test-model', function () {
    // menampilkan semua data dari model Post
    $data = App\Models\Post::all();
    return $data;
});

// tambah data
Route::get('create-data', function () {
    // membuat data baru melalui model
    $data = App\Models\Post::create([
        'title'   => 'Lord Suroso Nyentang Kyai',
        'content' => 'Lorem Ipsum',
    ]);
    return redirect('test-model');
});

Route::get('show-data/{id}', function ($id) {
    // menampilkan data berdasarkan parameter 'id'
    $data = App\Models\Post::find($id);
    return $data;
});

Route::get('edit-data/{id}', function ($id) {
    // mengeupdate data berdasarkan id
    $data          = App\Models\Post::find($id);
    $data->title   = "Membangun Project dengan Laravel";
    $data->content = "Ipsum Lorem";
    $data->save();
    return $data;
});

Route::get('delete-data/{id}', function ($id) {
    // menghapus data berdasarkan parameter id
    $data = App\Models\Post::find($id);
    $data->delete();
    // di kembalikan (alihkan) ke halaman test model
    return redirect('test-model');
});

Route::get('search/{cari}', function ($query) {
    // mencari data berdasarkan title yang mirip seperti (like) ......
    $data = App\Models\Post::where('title', 'like', '%' . $query . '%')->get();
    return $data;
});

// pemanggilan url menggunakan controller
Route::get('greetings', [MyController::class, 'hello']);
Route::get('student', [MyController::class, 'siswa']);

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// post
Route::get('post', [PostController::class, 'index'])->name('post.index');
// tambah data post
Route::get('post/create', [PostController::class, 'create'])->name('post.create');
Route::post('post', [PostController::class, 'store'])->name('post.store');
// edit data post
Route::get('post/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
Route::put('post/{id}', [PostController::class, 'update'])->name('post.update');

// show data
Route::get('post/{id}', [PostController::class, 'show'])->name('post.show');

// hapus data
Route::delete('post/{id}', [PostController::class, 'destroy'])->name('post.delete');

// produk
Route::resource('produk', App\Http\Controllers\ProdukController::class)->middleware('auth');

// relasi
use Illuminate\Support\Facades\Route;

// one to one
Route::get('/one-to-one', [RelasiController::class, 'oneToOne']);
Route::get('/wali-ke-mahasiswa', function () {
    $wali = App\Models\Wali::with('mahasiswa')->first();
    return "{$wali->nama} adalah wali dari {$wali->mahasiswa->nama}";
});

// one to many
Route::get('/one-to-many', [RelasiController::class, 'oneToMany']);
Route::get('/mahasiswa-ke-dosen', function () {
    $mhs = App\Models\Mahasiswa::where('nim', '123457')->first();
    return "{$mhs->nama} dibimbing oleh {$mhs->dosen->nama}";
});
Route::get('/many-to-many', [RelasiController::class, 'manyToMany']);

Route::get('eloquent', [RelasiController::class, 'eloquent']);

// CRUD One To Many
Route::resource('mahasiswa', App\Http\Controllers\MahasiswaController::class);
// CRUD One To One
Route::resource('wali', App\Http\Controllers\WaliController::class);

Route::prefix('latihan')->group(function () {
    Route::resource('pelanggan', App\Http\Controllers\PelangganController::class);
    Route::resource('produk', App\Http\Controllers\ProdukController::class);
    Route::resource('transaksi', App\Http\Controllers\TransaksiController::class);
    Route::resource('pembayaran', App\Http\Controllers\PembayaranController::class);
})->middleware('auth');
