@extends('layouts.sidebar')

@section('content')
<div style="max-width: 600px;">

    <h4 style="font-weight:600; margin-bottom:20px;">
        Tambah Pengguna
    </h4>

    <div style="
        background: rgba(255,255,255,0.05);
        padding:25px;
        border-radius:16px;
        border:1px solid rgba(255,255,255,0.05);
    ">

        <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <!-- NAME -->
        <div style="margin-bottom:18px;">
            <label style="font-size:14px; color:#94a3b8;">Nama</label>

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

        <!-- EMAIL -->
        <div style="margin-bottom:18px;">
            <label style="font-size:14px; color:#94a3b8;">Email</label>

            <input type="email" name="email"
                value="{{ old('email') }}"
                required
                style="
                    width:100%;
                    padding:10px;
                    margin-top:6px;
                    background:#020617;
                    border:1px solid rgba(255,255,255,0.08);
                    border-radius:8px;
                    color:white;
                "
                onfocus="this.style.border='1px solid #3b82f6'"
                onblur="this.style.border='1px solid rgba(255,255,255,0.08)'"
            >

            <div style="
                font-size:12px;
                color:#94a3b8;
                margin-top:5px;
            ">
                Password akan dibuat otomatis dari email + ID user
            </div>

            @error('email')
                <div style="color:#f87171; font-size:13px; margin-top:5px;">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- ROLE -->
        <div style="margin-bottom:25px;">
            <label style="font-size:14px; color:#94a3b8;">Role</label>

            <select name="role" required
                style="
                    width:100%;
                    padding:10px;
                    margin-top:6px;
                    background:#020617;
                    border:1px solid rgba(255,255,255,0.08);
                    border-radius:8px;
                    color:white;
                "
                onfocus="this.style.border='1px solid #3b82f6'"
                onblur="this.style.border='1px solid rgba(255,255,255,0.08)'"
            >
                <option value="">Pilih Role</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
            </select>

            @error('role')
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
                ">
                Simpan
            </button>

            <a href="{{ route('users.index') }}"
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