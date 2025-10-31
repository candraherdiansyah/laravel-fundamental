@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Edit Transaksi #{{ $transaksi->kode_transaksi }}</h3>

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Terjadi kesalahan:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $err)
            <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="id_pelanggan" class="form-label">Pelanggan</label>
            <select name="id_pelanggan" id="id_pelanggan" class="form-select" required>
                <option value="">-- Pilih Pelanggan --</option>
                @foreach ($pelanggan as $p)
                <option value="{{ $p->id }}" {{ $transaksi->id_pelanggan == $p->id ? 'selected' : '' }}>
                    {{ $p->nama }}
                </option>
                @endforeach
            </select>
        </div>

        <hr>

        <h5>Daftar Produk</h5>

        <div id="produk-wrapper">
            @foreach ($transaksi->detailTransaksi as $detail)
            <div class="row produk-item mb-2">
                <div class="col-md-5">
                    <label class="form-label">Produk</label>
                    <select name="id_produk[]" class="form-select produk-select" required>
                        <option value="">-- Pilih Produk --</option>
                        @foreach ($produk as $prod)
                        <option value="{{ $prod->id }}" data-harga="{{ $prod->harga }}" {{ $detail->id_produk ==
                            $prod->id ? 'selected' : '' }}>
                            {{ $prod->nama_produk }} - Rp{{ number_format($prod->harga, 0, ',', '.') }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Jumlah</label>
                    <input type="number" name="jumlah[]" class="form-control jumlah-input" min="1"
                        value="{{ $detail->jumlah }}" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Subtotal</label>
                    <input type="text" class="form-control subtotal" readonly
                        value="Rp{{ number_format($detail->sub_total, 0, ',', '.') }}">
                </div>

                <div class="col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-danger btn-remove w-100">×</button>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mb-3 text-end">
            <button type="button" class="btn btn-secondary" id="btn-add">+ Tambah Produk</button>
        </div>

        <div class="mb-3 text-end">
            <h5>Total Harga: <span id="totalHarga">Rp{{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
            </h5>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Update Transaksi</button>
        </div>
    </form>
</div>

<script>
    function hitungSubtotal() {
        let total = 0;
        document.querySelectorAll('.produk-item').forEach(item => {
            let select = item.querySelector('.produk-select');
            let jumlah = item.querySelector('.jumlah-input');
            let subtotalInput = item.querySelector('.subtotal');

            let harga = select.selectedOptions[0]?.getAttribute('data-harga') || 0;
            let sub = parseInt(harga) * parseInt(jumlah.value || 0);
            subtotalInput.value = 'Rp' + sub.toLocaleString('id-ID');
            total += sub;
        });
        document.getElementById('totalHarga').innerText = 'Rp' + total.toLocaleString('id-ID');
    }

    document.addEventListener('input', hitungSubtotal);
    document.addEventListener('change', hitungSubtotal);

    document.getElementById('btn-add').addEventListener('click', function() {
        let wrapper = document.getElementById('produk-wrapper');
        let newRow = wrapper.firstElementChild.cloneNode(true);

        newRow.querySelectorAll('input').forEach(i => i.value = i.classList.contains('jumlah-input') ? 1 : 0);
        newRow.querySelector('.produk-select').value = '';

        wrapper.appendChild(newRow);
        hitungSubtotal();
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-remove')) {
            let items = document.querySelectorAll('.produk-item');
            if (items.length > 1) {
                e.target.closest('.produk-item').remove();
                hitungSubtotal();
            }
        }
    });

    document.addEventListener('DOMContentLoaded', hitungSubtotal);
</script>
@endsection