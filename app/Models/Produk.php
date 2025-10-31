<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = ['nama_produk', 'stok', 'harga'];
    protected $visible  = ['nama_produk', 'stok', 'harga'];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_produk');
    }
}
