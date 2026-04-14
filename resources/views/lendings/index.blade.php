@extends('layouts.sidebar')

@section('content')
<div>

    <!-- HEADER -->
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <h4 style="font-weight:600; color:#1f2937;">Daftar Peminjaman</h4>

        <div style="display:flex; gap:10px;">
            <a href="{{ route('lendings.export') }}"
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

            @if(auth()->user()->role == 'staff')
                <a href="{{ route('lendings.create') }}"
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
        overflow-x:auto;
        border:1px solid #e5e7eb;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    ">

        <table style="width:100%; border-collapse:collapse; min-width:800px;">

            <!-- HEAD -->
            <thead style="background: #f9fafb; border-bottom: 1px solid #e5e7eb;">
                <tr style="color: #374151; font-size: 14px; font-weight: 600; text-align:left;">
                    <th style="padding:14px;">No</th>
                    <th>Barang</th>
                    <th>Total</th>
                    <th>Peminjam</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Editor</th>
                    @if(auth()->user()->role == 'staff')
                        <th>Aksi</th>
                    @endif
                </tr>
            </thead>

            <!-- BODY -->
            <tbody>
                @forelse($lendings as $lending)
                <tr style="border-bottom:1px solid #f3f4f6; color: #4b5563;">

                    <td style="padding:14px;">{{ $loop->iteration }}</td>
                    <td>{{ $lending->item->name ?? '-' }}</td>
                    <td>{{ $lending->total }}</td>
                    <td>{{ $lending->name }}</td>
                    <td>{{ $lending->keterangan ?? '-' }}</td>

                    <!-- DATE -->
                    <td>
                        {{ \Carbon\Carbon::parse($lending->date)->format('d M Y') }}
                    </td>

                    <!-- STATUS -->
                    <td>
    @if($lending->returned_at)
        <span style="
            background:#dcfce7;
            color:#166534;
            padding:4px 10px;
            border-radius:6px;
            font-size:12px;
            font-weight:500;
            display:inline-block;
        ">
            Kembali
        </span>

        <!-- TANGGAL + JAM -->
        <div style="font-size:11px; color:#6b7280; margin-top:4px;">
            {{ \Carbon\Carbon::parse($lending->returned_at)->format('d M Y H:i') }}
        </div>
    @else
        <span style="
            background:#fef9c3;
            color:#854d0e;
            padding:4px 10px;
            border-radius:6px;
            font-size:12px;
            font-weight:500;
            display:inline-block;
        ">
            Dipinjam
        </span>

        <!-- OPSIONAL: tampilkan jam pinjam -->
        <div style="font-size:11px; color:#6b7280; margin-top:4px;">
            {{ \Carbon\Carbon::parse($lending->date)->format('d M Y H:i') }}
        </div>
    @endif
</td>

                    <td>{{ $lending->editor->name ?? '-' }}</td>

                    @if(auth()->user()->role == 'staff')
<td>

    @if(!$lending->returned_at)
        <!-- RETURN -->
        <form action="{{ route('lendings.return', $lending->id) }}"
              method="POST" style="display:inline;">
            @csrf
            @method('PUT')

            <button type="submit"
                style="
                    padding:5px 10px;
                    background:#22c55e;
                    border:none;
                    border-radius:6px;
                    font-size:12px;
                    color:white;
                    cursor:pointer;
                ">
                Return
            </button>
        </form>
    @else
        <!-- DONE BADGE -->
        <span style="
            background:#dcfce7;
            color:#166534;
            padding:5px 10px;
            border-radius:6px;
            font-size:12px;
            font-weight:500;
        ">
            Done
        </span>
    @endif

</td>
@endif

                </tr>
                @empty
                <tr>
                    <td colspan="{{ auth()->user()->role == 'staff' ? 9 : 8 }}"
                        style="padding:20px; text-align:center; color:#9ca3af;">
                        Belum ada data peminjaman
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>
@endsection