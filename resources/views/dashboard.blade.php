@extends('layouts.sidebar')

@section('content')
<div>
    
    <h4 style="font-weight:600; margin-bottom:20px;">
        Dashboard
    </h4>

    <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:15px;">
        <!-- TOTAL ITEM -->
        <div style="background:rgba(59,130,246,0.15); padding:20px; border-radius:12px;">
            <div style="font-size:13px; color:#93c5fd;">Total Barang</div>
            <div style="font-size:22px; font-weight:bold;">{{ $totalItems ?? 0 }}</div>
        </div>

        <!-- DIPINJAM -->
        <div style="background:rgba(234,179,8,0.15); padding:20px; border-radius:12px;">
            <div style="font-size:13px; color:#fde68a;">Sedang Dipinjam</div>
            <div style="font-size:22px; font-weight:bold;">{{ $totalBorrowed ?? 0 }}</div>
        </div>

        <!-- RUSAK -->
        <div style="background:rgba(239,68,68,0.15); padding:20px; border-radius:12px;">
            <div style="font-size:13px; color:#fca5a5;">Barang Rusak</div>
            <div style="font-size:22px; font-weight:bold;">{{ $totalBroken ?? 0 }}</div>
        </div>

    </div>

    <div style="margin-top:25px; color:#94a3b8;">
        Selamat datang, {{ auth()->user()->name }}
    </div>

</div>
@endsection