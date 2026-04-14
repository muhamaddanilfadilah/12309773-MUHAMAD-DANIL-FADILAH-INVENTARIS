<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris - Landing Page</title>
    @vite(['resources/css/app.css','resources/js/app.js'])

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.7);
            backdrop-filter: blur(5px);
            animation: fadeIn 0.3s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .modal-content {
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.95), rgba(15, 23, 42, 0.95));
            backdrop-filter: blur(10px);
            margin: 10% auto;
            width: 400px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.5);
            animation: slideDown 0.3s ease;
            border: 1px solid rgba(255,255,255,0.1);
        }
        
        @keyframes slideDown {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        .close {
            color: #94a3b8;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
            line-height: 20px;
        }
        
        .close:hover {
            color: #ef4444;
        }
        
        /* Form Styles */
        .form-input {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            background: rgba(51, 65, 85, 0.8);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            color: white;
            outline: none;
            transition: 0.2s;
        }
        
        .form-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59,130,246,0.2);
        }
        
        .login-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(90deg, #255aae, #1847ad);
            border: none;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            transition: 0.3s;
            cursor: pointer;
        }
        
        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(37, 90, 174, 0.4);
        }
        
        .error-alert {
            background: rgba(239,68,68,0.2);
            color: #f87171;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 14px;
            border-left: 3px solid #ef4444;
        }
    </style>
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
                <button onclick="openModal()" 
                   style="
                        background: linear-gradient(90deg, #255aae, #1847ad);
                        padding: 12px 28px;
                        border-radius: 10px;
                        color: white;
                        text-decoration: none;
                        font-weight: 500;
                        transition: 0.3s;
                        border: none;
                        cursor: pointer;
                   "
                   onmouseover="this.style.opacity='0.8'"
                   onmouseout="this.style.opacity='1'"
                >
                    Masuk →
                </button>
            </div>
        </div>

        <!-- IMAGE -->
        <div class="col-md-6 text-center">
            <img src="{{ asset('images/inventaris3.png') }}" 
                 style="
                    max-height: 320px;
                    border-radius: 20px;
                    box-shadow: 0 10px 40px rgba(0,0,0,0.5);
                 ">
        </div>

    </div>
</div>

<!-- MODAL LOGIN -->
<div id="loginModal" class="modal">
    <div class="modal-content" style="padding: 30px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h4 style="font-weight: 600; margin: 0; color: white;">Masuk ke Akun Anda</h4>
            <span class="close" onclick="closeModal()">&times;</span>
        </div>

        @if(session('error'))
            <div class="error-alert">
                {{ session('error') }}
            </div>
        @endif

        <form action="/login" method="POST" id="loginForm">
            @csrf

            <!-- EMAIL -->
            <div style="margin-bottom: 20px;">
                <label style="font-size: 14px; color: #cbd5e1;">Email</label>
                <input type="email" name="email" required class="form-input" placeholder="contoh@email.com">
            </div>

            <!-- PASSWORD -->
            <div style="margin-bottom: 25px;">
                <label style="font-size: 14px; color: #cbd5e1;">Password</label>
                <input type="password" name="password" required class="form-input" placeholder="********">
            </div>

            <!-- BUTTON -->
            <button type="submit" class="login-btn">
                Masuk
            </button>
        </form>
    </div>
</div>

<script>
    // Open modal
    function openModal() {
        document.getElementById('loginModal').style.display = 'block';
        document.body.style.overflow = 'hidden'; // Prevent scrolling
    }
    
    // Close modal
    function closeModal() {
        document.getElementById('loginModal').style.display = 'none';
        document.body.style.overflow = 'auto'; // Restore scrolling
    }
    
    // Close modal when clicking outside
    window.onclick = function(event) {
        let modal = document.getElementById('loginModal');
        if (event.target == modal) {
            closeModal();
        }
    }
    
    // Jika ada error dari server, modal akan otomatis terbuka
    @if(session('error'))
        document.addEventListener('DOMContentLoaded', function() {
            openModal();
        });
    @endif
</script>

</body>
</html>