@extends('layouts.sidebar')

@section('content')
<div style="max-width:600px;">

    <h4 style="font-weight:600; margin-bottom:20px;">
        Edit Pengguna
    </h4>

    <div style="background: rgba(255,255,255,0.05); padding:25px; border-radius:16px; border:1px solid rgba(255,255,255,0.05);">

        <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- NAME -->
        <div style="margin-bottom:18px;">
            <label style="font-size:14px; color:#94a3b8;">Nama</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                style="width:100%; padding:10px; margin-top:6px; background:#020617; border:1px solid rgba(255,255,255,0.08); border-radius:8px; color:white;">
        </div>

        <!-- EMAIL -->
        <div style="margin-bottom:18px;">
            <label style="font-size:14px; color:#94a3b8;">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                style="width:100%; padding:10px; margin-top:6px; background:#020617; border:1px solid rgba(255,255,255,0.08); border-radius:8px; color:white;">
        </div>

        <!-- ROLE -->
        <div style="margin-bottom:18px;">
            <label style="font-size:14px; color:#94a3b8;">Role</label>
            <select name="role"
                style="width:100%; padding:10px; margin-top:6px; background:#020617; border:1px solid rgba(255,255,255,0.08); border-radius:8px; color:white;">
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff</option>
            </select>
        </div>

        <!-- PASSWORD -->
        <div style="margin-bottom:25px;">
            <label style="font-size:14px; color:#94a3b8;">Password Baru (Opsional)</label>

            <input type="password" name="new_password"
                style="width:100%; padding:10px; margin-top:6px; background:#020617; border:1px solid rgba(255,255,255,0.08); border-radius:8px; color:white;">

            <div style="font-size:12px; color:#94a3b8; margin-top:5px;">
                Kosongkan jika tidak ingin mengubah password
            </div>
        </div>

        <!-- BUTTON -->
        <div style="display:flex; gap:10px;">
            <button type="submit"
                style="padding:10px 18px; background: linear-gradient(90deg,#22c55e,#16a34a); border:none; border-radius:8px; color:white;">
                Update
            </button>

            <a href="{{ route('users.index') }}"
                style="padding:10px 18px; background:#1e293b; border-radius:8px; color:#cbd5f5; text-decoration:none;">
                Batal
            </a>
        </div>

        </form>
    </div>
</div>
@endsection