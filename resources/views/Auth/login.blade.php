<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/app.css','resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>

<body style="
    font-family: 'Inter', sans-serif;
    background: radial-gradient(circle at top, #1e293b, #020617);
    color: #e5e7eb;
">

<div class="d-flex justify-content-center align-items-center vh-100">

    <div style="
        width: 380px;
        background: rgba(255,255,255,0.05);
        border-radius: 16px;
        padding: 30px;
        backdrop-filter: blur(10px);
        box-shadow: 0 10px 40px rgba(0,0,0,0.5);
        background-image: url('{{ asset('images/inventory10.png') }}');
        background-size: cover;
        background-position: center;
    ">

        <h4 style="text-align:center; font-weight:600; margin-bottom:25px; color:#393838;">Masuk ke akun anda
        </h4>

        @if(session('error'))
            <div style="
                background: rgba(239,68,68,0.2);
                color: #f87171;
                padding: 10px;
                border-radius: 8px;
                margin-bottom: 15px;
                font-size: 14px;
            ">
                {{ session('error') }}
            </div>
        @endif

        <form action="/login" method="POST">
        @csrf

        <!-- EMAIL -->
        <div style="margin-bottom:15px;">
            <label style="font-size:14px; color:#393838;">Email</label>
            <input type="email" name="email" required
                style="
                    width:100%;
                    padding:10px;
                    margin-top:5px;
                    background:#5a5a5a;
                    border:1px solid rgba(255,255,255,0.08);
                    border-radius:8px;
                    color:white;
                    outline:none;
                ">
        </div>

        <!-- PASSWORD -->
        <div style="margin-bottom:20px;">
            <label style="font-size:14px; color:#393838;">Password</label>
            <input type="password" name="password" required
                style="
                    width:100%;
                    padding:10px;
                    margin-top:5px;
                    background:#5a5a5a;
                    border:1px solid rgba(255,255,255,0.08);
                    border-radius:8px;
                    color:white;
                    outline:none;
                ">
        </div>

        <!-- BUTTON -->
        <button type="submit"
            style="
                width:100%;
                padding:12px;
                background: linear-gradient(90deg, #242424, #2c2c2c);
                border:none;
                border-radius:10px;
                color:white;
                font-weight:500;
                transition:0.2s;
            "
            onmouseover="this.style.opacity='0.85'"
            onmouseout="this.style.opacity='1'"
        >
            Masuk
        </button>

        </form>
    </div>

</div>

</body>
</html>