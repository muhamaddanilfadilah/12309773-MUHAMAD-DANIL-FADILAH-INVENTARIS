@extends('layouts.sidebar')

@section('content')
<div>

    <!-- HEADER -->
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <h4 style="font-weight:600; color:#1f2937;">Daftar Barang</h4>

        <div style="display:flex; gap:10px;">
            <a href="{{ route('items.export') }}"
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

            @if(auth()->user()->role == 'admin')
                <a href="{{ route('items.create') }}"
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

    <!-- TABLE -->
    <div style="
        background: #ffffff;
        border-radius:14px;
        overflow:hidden;
        border:1px solid #e5e7eb;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    ">

        <table style="width:100%; border-collapse:collapse;">

            <!-- HEAD -->
            <thead style="background: #f9fafb; border-bottom: 1px solid #e5e7eb;">
                <tr style="color: #374151; font-size: 14px; font-weight: 600;">
                    <th style="padding:14px; text-align:left;">No</th>
                    <th style="text-align:left;">Kategori</th>
                    <th style="text-align:left;">Nama Barang</th>
                    <th style="text-align:left;">Total</th>

                    @if(auth()->user()->role == 'staff')
                        <th style="text-align:left;">Tersedia</th>
                    @endif

                    <th style="text-align:left;">Rusak</th>
                    <th style="text-align:left;">Dipinjam</th>

                    @if(auth()->user()->role == 'admin')
                        <th style="text-align:left;">Aksi</th>
                    @endif
                </tr>
            </thead>

            <!-- BODY -->
            <tbody>
                @forelse($items as $item)
                <tr style="border-bottom:1px solid #f3f4f6; color: #4b5563;">

                    <td style="padding:14px;">{{ $loop->iteration }}</td>
                    <td>{{ $item->category->name ?? '-' }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->total }}</td>

                    @if(auth()->user()->role == 'staff')
                    <td>
                        <span style="
                            background: {{ $item->available > 0 ? '#dcfce7' : '#fee2e2' }};
                            color: {{ $item->available > 0 ? '#166534' : '#991b1b' }};
                            padding:4px 10px;
                            border-radius:6px;
                            font-size:12px;
                            font-weight:500;
                        ">
                            {{ $item->available }}
                        </span>
                    </td>
                    @endif

                    <!-- REPAIR -->
                    <td>
                        <span style="
                            background:#ffedd5;
                            color:#9a3412;
                            padding:4px 10px;
                            border-radius:6px;
                            font-size:12px;
                            font-weight:500;
                        ">
                            {{ $item->repair }}
                        </span>
                    </td>

                    <!-- LENDING -->
                    <td>
                        <span style="
                            background:#fef9c3;
                            color:#854d0e;
                            padding:4px 10px;
                            border-radius:6px;
                            font-size:12px;
                            font-weight:500;
                        ">
                            {{ $item->lendings_sum_total ?? 0 }}
                        </span>
                    </td>

                    @if(auth()->user()->role == 'admin')
<td style="display:flex; gap:6px;">

    <!-- EDIT -->
    <a href="{{ route('items.edit', $item->id) }}"
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
    <form action="{{ route('items.destroy', $item->id) }}"
          method="POST"
          onsubmit="return confirm('Yakin hapus barang ini?');">
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
                    <td colspan="{{ auth()->user()->role == 'staff' ? 8 : 7 }}"
                        style="padding:20px; text-align:center; color:#9ca3af;">
                        Belum ada data barang
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>
@endsection