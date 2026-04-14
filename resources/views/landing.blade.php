<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris</title>
    @vite(['resources/css/app.css','resources/js/app.js'])

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body style="font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #0f172a, #1e293b); color: white;">

<div class="container vh-100 d-flex align-items-center">
    <div class="row w-100 align-items-center">

        <!-- TEXT -->
        <div class="col-md-6">
            <h1 style="font-size: 48px; font-weight: 700;">
                Sistem Inventaris 
            </h1>

            <p style="color: #94a3b8; margin-top: 15px;">
                Kelola inventaris Anda dengan mudah dan efisien. Sistem kami menyediakan pelacakan waktu nyata, peringatan otomatis, dan analitik mendalam untuk membantu Anda mengelola stok secara efektif.
            </p>

            <div style="margin-top: 25px;">
                <a href="/login" 
                   style="
                        background: linear-gradient(90deg, #255aae, #1847ad);
                        padding: 12px 28px;
                        border-radius: 10px;
                        color: white;
                        text-decoration: none;
                        font-weight: 500;
                        transition: 0.3s;
                   "
                   onmouseover="this.style.opacity='0.8'"
                   onmouseout="this.style.opacity='1'"
                >
                    Masuk →
                </a>
            </div>
        </div>

        <!-- IMAGE -->
        <div class="col-md-6 text-center">
            <img src="{{ asset('images/inventory2.png') }}" 
                 style="
                    max-height: 320px;
                    border-radius: 20px;
                    box-shadow: 0 10px 40px rgba(0,0,0,0.5);
                 ">
        </div>

    </div>
</div>

</body>
</html>