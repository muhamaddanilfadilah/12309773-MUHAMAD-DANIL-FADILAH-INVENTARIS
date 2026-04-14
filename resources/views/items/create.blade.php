@extends('layouts.sidebar')

@section('content')
<div style="max-width: 650px;">

    <h4 style="font-weight: 600; margin-bottom: 20px;">
        Tambah Barang
    </h4>

    <div style="
        background: rgba(255,255,255,0.05);
        padding: 25px;
        border-radius: 16px;
        border: 1px solid rgba(255,255,255,0.05);
    ">

        <form action="{{ route('items.store') }}" method="POST">
        @csrf

        <!-- CATEGORY -->
        <div style="margin-bottom: 18px;">
            <label style="font-size: 14px; color:#94a3b8;">
                Kategori
            </label>

            <select name="category_id" required
                style="
                    width:100%;
                    padding:10px;
                    margin-top:6px;
                    background:#020617;
                    border:1px solid rgba(255,255,255,0.08);
                    border-radius:8px;
                    color:white;
                    outline:none;
                "
                onfocus="this.style.border='1px solid #3b82f6'"
                onblur="this.style.border='1px solid rgba(255,255,255,0.08)'"
            >
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            @error('category_id')
                <div style="color:#f87171; font-size:13px; margin-top:5px;">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- ITEM NAME -->
        <div style="margin-bottom: 18px;">
            <label style="font-size: 14px; color:#94a3b8;">
                Nama Barang
            </label>

            <input type="text" name="name"
                value="{{ old('name') }}"
                required
                style="
                    width:100%;
                    padding:10px;
                    margin-top:6px;
                    background:#020617;
                    border:1px solid rgba(255,255,255,0.08);
                    border-radius:8px;
                    color:white;
                    outline:none;
                "
                onfocus="this.style.border='1px solid #3b82f6'"
                onblur="this.style.border='1px solid rgba(255,255,255,0.08)'"
            >

            @error('name')
                <div style="color:#f87171; font-size:13px; margin-top:5px;">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- TOTAL -->
        <div style="margin-bottom: 25px;">
            <label style="font-size: 14px; color:#94a3b8;">
                Total Barang
            </label>

            <input type="number" name="total"
                value="{{ old('total', 0) }}"
                min="0"
                required
                style="
                    width:100%;
                    padding:10px;
                    margin-top:6px;
                    background:#020617;
                    border:1px solid rgba(255,255,255,0.08);
                    border-radius:8px;
                    color:white;
                    outline:none;
                "
                onfocus="this.style.border='1px solid #3b82f6'"
                onblur="this.style.border='1px solid rgba(255,255,255,0.08)'"
            >

            @error('total')
                <div style="color:#f87171; font-size:13px; margin-top:5px;">
                    {{ $message }}
                </div>
            @enderror
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
                    font-weight:500;
                ">
                Simpan
            </button>

            <a href="{{ route('items.index') }}"
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
@endsection