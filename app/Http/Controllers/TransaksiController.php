<?php
namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{

    public function index()
    {
        $transaksi = Transaksi::all();
        return view('latihan.transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        $pelanggan = Pelanggan::all();
        $produk    = Produk::all();
        return view('latihan.transaksi.create', compact('pelanggan', 'produk'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pelanggan' => 'required|exists:pelanggans,id',
            'id_produk'    => 'required|array',
            'id_produk.*'  => 'exists:produks,id',
            'jumlah'       => 'required|array',
            'jumlah.*'     => 'integer|min:1',
        ]);

        // Buat transaksi dulu
        $kode                      = 'TRX-' . strtoupper(uniqid());
        $transaksi                 = new Transaksi();
        $transaksi->kode_transaksi = $kode;
        $transaksi->id_pelanggan   = $request->id_pelanggan;
        $transaksi->tanggal        = now();
        $transaksi->total_harga    = 0;
        $transaksi->save();

        $totalHarga = 0;

        foreach ($request->id_produk as $index => $produkId) {
            $produk   = Produk::findOrFail($produkId);
            $jumlah   = $request->jumlah[$index];
            $subtotal = $produk->harga * $jumlah;

            // Buat detail transaksi (harus setelah $transaksi disimpan)
            $transaksi->detailTransaksi()->create([
                'id_transaksi' => $transaksi->id,
                'id_produk'    => $produkId,
                'jumlah'       => $jumlah,
                'sub_total'    => $subtotal,
            ]);

            // Kurangi stok produk
            $produk->stok -= $jumlah;
            $produk->save();

            $totalHarga += $subtotal;
        }

        // Update total harga
        $transaksi->total_harga = $totalHarga;
        $transaksi->save();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaksi = Transaksi::with(['pelanggan', 'detailTransaksi.produk'])->findOrFail($id);
        return view('latihan.transaksi.show', compact('transaksi'));
    }

    public function edit($id)
    {
        $transaksi = Transaksi::with('detailTransaksi.produk')->findOrFail($id);
        $pelanggan = Pelanggan::all();
        $produk    = Produk::all();

        return view('latihan.transaksi.edit', compact('transaksi', 'pelanggan', 'produk'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_pelanggan' => 'required|exists:pelanggans,id',
            'id_produk'    => 'required|array',
            'id_produk.*'  => 'exists:produks,id',
            'jumlah'       => 'required|array',
            'jumlah.*'     => 'integer|min:1',
        ]);

        $transaksi = Transaksi::findOrFail($id);

        // Update data transaksi
        $transaksi->id_pelanggan = $request->id_pelanggan;
        $transaksi->tanggal      = now();
        $transaksi->total_harga  = 0;
        $transaksi->save();

        // Hapus detail lama dulu
        $transaksi->detailTransaksi()->delete();

        $totalHarga = 0;

        foreach ($request->id_produk as $index => $produkId) {
            $produk   = Produk::findOrFail($produkId);
            $jumlah   = $request->jumlah[$index];
            $subtotal = $produk->harga * $jumlah;

            $transaksi->detailTransaksi()->create([
                'id_transaksi' => $transaksi->id,
                'id_produk'    => $produkId,
                'jumlah'       => $jumlah,
                'sub_total'    => $subtotal,
            ]);

            $totalHarga += $subtotal;
        }

        $transaksi->total_harga = $totalHarga;
        $transaksi->save();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaksi = Transaksi::with('detailTransaksi')->findOrFail($id);

        // Kembalikan stok produk
        foreach ($transaksi->detailTransaksi as $detail) {
            $produk = Produk::find($detail->id_produk); // pastikan pakai id_produk sesuai field di table
            if ($produk) {
                $produk->stok += $detail->jumlah;
                $produk->save();
            }
        }

        // Hapus semua detail transaksi dulu
        $transaksi->detailTransaksi()->delete();

        // Baru hapus transaksi utamanya
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus dan stok dikembalikan!');
    }

}
