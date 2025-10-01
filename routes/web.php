<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// basic
Route::get('about', function(){
    return '<h1>Hallo </h1>'.
           '<br>Selamat Datang di Perpustakaan Digital';
});

Route::get('buku', function(){
    return view('buku');
});

Route::get('menu',function(){
    // multi data / array
    $data = [
        ['nama_makanan'=>'Bala-bala','harga'=>1000,'jumlah'=>10],
        ['nama_makanan'=>'Gehu Pedas','harga'=>2000,'jumlah'=>15],
        ['nama_makanan'=>'Cireng Isi Ayam','harga'=>2500,'jumlah'=>5],
    ];
    // single data
    $resto = "Resto MPL - Makanan Penuh Lemak";
    // compact fungisnya untuk mengirim collection data(array)
    // yang ada di variabel ke dalam sebuah view
    return view('menu',compact('data','resto'));
});

// route Parameter (Nilai)
Route::get('books/{judul}',function($a){
    return 'Judul Buku : '.$a;
});

Route::get('post/{title}/{category}', function($a, $b){
    // compact assosiatif
    return view('post',['judul'=>$a, 'cat' =>$b]);
});

// Route Optional Parameter
// ditandai dengan ?
Route::get('profile/{nama?}',function($a = "guest"){
    return 'Halo saya '.$a;
});


Route::get('order/{item?}', function($a = "Nasi"){
    return view('order',compact('a'));
});


// Test Model
Route::get('test-model',function(){
    // menampilkan semua data dari model Post
    $data = App\Models\Post::all();
    return $data;
});

Route::get('create-data-post',function(){
    $data = App\Models\Post::create([
        'title'=>'Belajar PHP',
        'content'=>'Lorem Ipsum'
    ]);
    return $data;
});
