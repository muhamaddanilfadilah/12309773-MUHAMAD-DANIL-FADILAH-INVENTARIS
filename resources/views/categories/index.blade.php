@extends('layouts.sidebar')

@section('content')
<div>

    <!-- HEADER -->
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <h4 style="font-weight:600; color:#1f2937;">Daftar Kategori</h4>

        @if(auth()->user()->role == 'admin')
            <a href="{{ route('categories.create') }}"
               style="
                    padding:10px 16px;
                    background: linear-gradient(90deg, #3b82f6, #6366f1);
                    border-radius:8px;
                    color:white;
                    text-decoration:none;
                    font-size:14px;
               ">
                Tambah
            </a>
        @endif
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

    <!-- TABLE CARD -->
    <div style="
        background: #ffffff;
        border-radius: 14px;
        overflow:hidden;
        border: 1px solid #e5e7eb;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    ">

        <table style="width:100%; border-collapse: collapse;">

            <!-- HEAD -->
            <thead style="background: #f9fafb; border-bottom: 1px solid #e5e7eb;">
                <tr style="text-align:left; color: #374151; font-size: 14px; font-weight: 600;">
                    <th style="padding:14px;">No</th>
                    <th>Nama Kategori</th>
                    <th>Penanggung Jawab</th>
                    <th>Total Item</th>
                    @if(auth()->user()->role == 'admin')
                        <th>Aksi</th>
                    @endif
                </tr>
            </thead>

            <!-- BODY -->
            <tbody>
                @forelse($categories as $category)
                <tr style="border-bottom:1px solid #f3f4f6; color: #4b5563;">

                    <td style="padding:14px;">{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>

                    <!-- BADGE -->
                    <td>
                        @if($category->division_pj == 'sarpras')
                            <span style="background:#e0f2fe; color:#0369a1; padding:4px 10px; border-radius:6px; font-size:12px; font-weight:500;">
                                Sarpras
                            </span>
                        @elseif($category->division_pj == 'tata_usaha')
                            <span style="background:#f1f5f9; color:#475569; padding:4px 10px; border-radius:6px; font-size:12px; font-weight:500;">
                                Tata Usaha
                            </span>
                        @elseif($category->division_pj == 'tefa')
                            <span style="background:#dcfce7; color:#166534; padding:4px 10px; border-radius:6px; font-size:12px; font-weight:500;">
                                Tefa
                            </span>
                        @endif
                    </td>

                    <td>{{ $category->total_items }}</td>

                    @if(auth()->user()->role == 'admin')
<td style="display:flex; gap:6px;">

    <!-- EDIT -->
    <a href="{{ route('categories.edit', $category->id) }}"
       style="
            padding:6px 12px;
            background:#fef08a;
            border-radius:6px;
            font-size:12px;
            color:#713f12;
            text-decoration:none;
            font-weight:500;
       ">
        Edit
    </a>

    <!-- DELETE -->
    <form action="{{ route('categories.destroy', $category->id) }}"
          method="POST"
          onsubmit="return confirm('Yakin hapus kategori ini?');">
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
                font-weight:500;
                cursor:pointer;
            ">
            Hapus
        </button>
    </form>

</td>
@endif

                </tr>
                @empty
                <tr>
                    <td colspan="{{ auth()->user()->role == 'admin' ? 5 : 4 }}"
                        style="padding:20px; text-align:center; color:#9ca3af;">
                        Belum ada data kategori
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>
@endsection