@extends('layouts.sidebar')

@section('content')
<div style="max-width: 750px;">

    <h4 style="font-weight:600; margin-bottom:20px;">
        Form Peminjaman
    </h4>

    <div style="
        background: rgba(255,255,255,0.05);
        padding:25px;
        border-radius:16px;
        border:1px solid rgba(255,255,255,0.05);
    ">

        <form action="{{ route('lendings.store') }}" method="POST">
        @csrf

        <!-- NAMA -->
        <div style="margin-bottom:15px;">
            <label style="font-size:14px; color:#94a3b8;">Nama Peminjam</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                style="width:100%; padding:10px; margin-top:6px; background:#020617; border:1px solid rgba(255,255,255,0.08); border-radius:8px; color:white;">
        </div>

        <!-- KETERANGAN -->
        <div style="margin-bottom:15px;">
            <label style="font-size:14px; color:#94a3b8;">Keterangan</label>
            <textarea name="keterangan"
                style="width:100%; padding:10px; margin-top:6px; background:#020617; border:1px solid rgba(255,255,255,0.08); border-radius:8px; color:white;">{{ old('keterangan') }}</textarea>
        </div>

        <!-- TANGGAL -->
        <div style="margin-bottom:20px;">
            <label style="font-size:14px; color:#94a3b8;">Tanggal</label>
            <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required
                style="width:100%; padding:10px; margin-top:6px; background:#020617; border:1px solid rgba(255,255,255,0.08); border-radius:8px; color:white;">
        </div>

        <!-- SECTION ITEM -->
        <div style="margin-bottom:10px; font-weight:500;">
            Data Barang
        </div>

        <div id="items-container">

            <!-- ROW -->
            <div class="item-row" style="
                display:flex;
                gap:10px;
                margin-bottom:12px;
            ">

                <select name="items[]" required
                    style="flex:2; padding:10px; background:#020617; border:1px solid rgba(255,255,255,0.08); border-radius:8px; color:white;">
                    <option value="">Pilih Barang</option>
                    @foreach($items as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>

                <input type="number" name="totals[]" min="1" required placeholder="Total"
                    style="flex:1; padding:10px; background:#020617; border:1px solid rgba(255,255,255,0.08); border-radius:8px; color:white;">
            </div>

        </div>

        <!-- ADD BUTTON -->
        <div style="margin-bottom:20px;">
            <button type="button" id="btn-more"
                style="
                    width:100%;
                    padding:10px;
                    background:#1e293b;
                    border-radius:8px;
                    color:#cbd5f5;
                    border:none;
                ">
                Tambah Barang
            </button>
        </div>

        <!-- BUTTON -->
        <div style="display:flex; gap:10px;">

            <button type="submit"
                style="
                    padding:10px 18px;
                    background: linear-gradient(90deg, #3b82f6, #6366f1);
                    border:none;
                    border-radius:8px;
                    color:white;
                ">
                Simpan
            </button>

            <a href="{{ route('lendings.index') }}"
                style="
                    padding:10px 18px;
                    background:#1e293b;
                    border-radius:8px;
                    color:#cbd5f5;
                    text-decoration:none;
                ">
                Batal
            </a>

        </div>

        </form>
    </div>
</div>

<!-- SCRIPT -->
<script>
document.getElementById('btn-more').addEventListener('click', function() {

    let container = document.getElementById('items-container');

    let row = document.createElement('div');
    row.className = 'item-row';
    row.style = "display:flex; gap:10px; margin-bottom:12px;";

    row.innerHTML = `
        <select name="items[]" required
            style="flex:2; padding:10px; background:#020617; border:1px solid rgba(255,255,255,0.08); border-radius:8px; color:white;">
            <option value="">Pilih Barang</option>
            @foreach($items as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>

        <input type="number" name="totals[]" min="1" required placeholder="Total"
            style="flex:1; padding:10px; background:#020617; border:1px solid rgba(255,255,255,0.08); border-radius:8px; color:white;">

        <button type="button"
            style="background:#ef4444; border:none; color:white; padding:0 12px; border-radius:6px;"
            onclick="this.parentElement.remove()">
            Hapus
        </button>
    `;

    container.appendChild(row);
});
</script>
@endsection