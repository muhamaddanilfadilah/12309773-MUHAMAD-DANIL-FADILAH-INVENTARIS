@extends('layouts.sidebar')

@section('content')
<div>

    <!-- HEADER -->
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h4 style="font-weight:600; color:#1f2937;">Daftar Users</h4>

    <div style="display:flex; gap:10px;">

        <!-- EXPORT EXCEL -->
        <a href="{{ route('users.export') }}"
           style="
                padding:10px 16px;
                background:#22c55e;
                border-radius:8px;
                color:white;
                text-decoration:none;
                font-size:14px;
           ">
            Export Excel
        </a>

        <!-- CREATE -->
        <a href="{{ route('users.create') }}"
           style="
                padding:10px 16px;
                background: linear-gradient(90deg, #3b82f6, #6366f1);
                border-radius:8px;
                color:white;
                text-decoration:none;
                font-size:14px;
           ">
            Create Account
        </a>

    </div>
</div>

    <!-- ALERT -->
    @if(session('success'))
        <div style="
            background: #dcfce7;
            color:#166534;
            padding:10px;
            border-radius:8px;
            margin-bottom:15px;
            font-size:14px;
            border-left: 4px solid #22c55e;
        ">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="
            background: #fee2e2;
            color:#991b1b;
            padding:10px;
            border-radius:8px;
            margin-bottom:15px;
            font-size:14px;
            border-left: 4px solid #ef4444;
        ">
            {{ session('error') }}
        </div>
    @endif

    <!-- TABLE -->
    <div style="
        background: #ffffff;
        border-radius:14px;
        overflow-x:auto;
        border:1px solid #e5e7eb;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    ">

        <table style="width:100%; border-collapse:collapse; min-width:600px;">

            <!-- HEAD -->
            <thead style="background: #f9fafb; border-bottom: 1px solid #e5e7eb;">
                <tr style="color: #374151; font-size: 14px; font-weight: 600; text-align:left;">
                    <th style="padding:14px;">No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <!-- BODY -->
            <tbody>
                @forelse($users as $user)
                <tr style="border-bottom:1px solid #f3f4f6; color: #4b5563;">

                    <td style="padding:14px;">{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>

                    <!-- ROLE -->
                    <td>
                        <span style="
                            background: {{ $user->role == 'admin' ? '#dbeafe' : '#f1f5f9' }};
                            color: {{ $user->role == 'admin' ? '#1e40af' : '#475569' }};
                            padding:4px 10px;
                            border-radius:6px;
                            font-size:12px;
                            font-weight:500;
                            display:inline-block;
                        ">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>

                    <!-- AKSI -->
                    <td style="display:flex; gap:6px; flex-wrap:wrap;">

                        @if(auth()->user()->role == 'admin')
                            <a href="{{ route('users.edit', $user->id) }}"
                               style="
                                    padding:6px 12px;
                                    background:#fef08a;
                                    border-radius:6px;
                                    font-size:12px;
                                    color:#713f12;
                                    text-decoration:none;
                                    font-weight:500;
                                    transition:0.2s;
                               "
                               onmouseover="this.style.background='#fde047'"
                               onmouseout="this.style.background='#fef08a'">
                                Edit
                            </a>
                        @endif

                        @if(auth()->user()->role == 'staff')
                            <form action="{{ route('users.reset-password', $user->id) }}" method="POST"
                                  onsubmit="return confirm('Reset password ke default?');">
                                @csrf
                                <button type="submit"
                                    style="
                                        padding:6px 12px;
                                        background:#38bdf8;
                                        border:none;
                                        border-radius:6px;
                                        font-size:12px;
                                        color:white;
                                        cursor:pointer;
                                        transition:0.2s;
                                    "
                                    onmouseover="this.style.background='#0ea5e9'"
                                    onmouseout="this.style.background='#38bdf8'">
                                    Reset
                                </button>
                            </form>
                        @endif

                        @if(auth()->id() != $user->id)
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin hapus user ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    style="
                                        padding:6px 12px;
                                        background:#ef4444;
                                        border:none;
                                        border-radius:6px;
                                        font-size:12px;
                                        color:white;
                                        cursor:pointer;
                                        transition:0.2s;
                                    "
                                    onmouseover="this.style.background='#dc2626'"
                                    onmouseout="this.style.background='#ef4444'">
                                    Hapus
                                </button>
                            </form>
                        @endif

                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="5"
                        style="padding:20px; text-align:center; color:#9ca3af;">
                        Belum ada data users
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>
@endsection