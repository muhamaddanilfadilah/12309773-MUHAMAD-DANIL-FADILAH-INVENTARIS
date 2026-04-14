@extends('layouts.sidebar')

@section('content')
<div>

    <h4 style="font-weight:600; margin-bottom:20px;">
        Dashboard
    </h4>

    <div style="
        background:#020617;
        border:1px solid rgba(255,255,255,0.05);
        padding:30px;
        border-radius:16px;
        color:#e2e8f0;
    ">
        <h2 style="font-size:22px; font-weight:600; margin-bottom:10px;">
            Selamat Datang, {{ auth()->user()->name }} 👋
        </h2>

        <p style="color:#94a3b8; line-height:1.6;">
            Ini adalah halaman dashboard sistem inventaris. 
            Di sini kamu bisa mengelola data barang, melakukan peminjaman, 
            serta memantau kondisi barang dengan mudah dan cepat.
        </p>

        <p style="margin-top:15px; color:#64748b;">
            Gunakan menu di sebelah kiri untuk mulai mengakses fitur yang tersedia.
        </p>
    </div>

</div>
@endsection