<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //secara otomatis model ini menganggap
    // table yang digunakan adalah table 'posts'

    // table yang digunakan untuk model ini adalah table 'post'
    protected $table = 'post';

    // apa aja yang boleh di isi
    public $fillable = ['title', 'content'];

    // apa aja yang boleh di tampilkan
    public $visible = ['id', 'title', 'content'];

    // mengisi tanggal kapan dibuat dan kapan di update secara otomatis
    public $timestamps = true;
}
