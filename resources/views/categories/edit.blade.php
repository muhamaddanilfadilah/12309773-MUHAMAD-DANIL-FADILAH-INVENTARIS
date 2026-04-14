@extends('layouts.sidebar')

@section('content')
<div style="max-width: 600px;">

    <h4 style="font-weight: 600; margin-bottom: 20px;">
        Edit Kategori
    </h4>

    <div style="
        background: rgba(255,255,255,0.05);
        padding: 25px;
        border-radius: 16px;
        border: 1px solid rgba(255,255,255,0.05);
    ">

        <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Nama Kategori -->
        <div style="margin-bottom: 18px;">
            <label style="font-size: 14px; color:#94a3b8;">
                Nama Kategori
            </label>

            <input type="text" name="name"
                value="{{ old('name', $category->name) }}"
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

        <!-- Divisi PJ -->
        <div style="margin-bottom: 25px;">
            <label style="font-size: 14px; color:#94a3b8;">
                Penanggung Jawab
            </label>

            <select name="division_pj" required
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
                <option value="sarpras" {{ old('division_pj', $category->division_pj) == 'sarpras' ? 'selected' : '' }}>Sarpras</option>
                <option value="tata_usaha" {{ old('division_pj', $category->division_pj) == 'tata_usaha' ? 'selected' : '' }}>Tata Usaha</option>
                <option value="tefa" {{ old('division_pj', $category->division_pj) == 'tefa' ? 'selected' : '' }}>Tefa</option>
            </select>

            @error('division_pj')
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
                    background: linear-gradient(90deg, #22c55e, #16a34a);
                    border:none;
                    border-radius:8px;
                    color:white;
                    font-weight:500;
                ">
                Update
            </button>

            <a href="{{ route('categories.index') }}"
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