<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>

<body style="font-family: 'Inter', sans-serif; background: #ffffff; color: #1f2937;">

<div class="d-flex">

    <!-- Sidebar -->
<div style="
    width: 200px;
    background: #f3f4f6;
    border-right: 1px solid #e5e7eb;
    min-height: 100vh;
    padding: 24px;
">

    <h5 style="
        font-weight: 600;
        margin-bottom: 25px;
        color: #111827;
        letter-spacing: 1px;
    ">
        𝐈𝐍𝐕𝐄𝐍𝐓𝐀𝐑𝐈𝐒
        
    </h5>
        <div style="background:#e0f2fe; padding:20px; border-radius:12px;">
        <div style="font-size:13px; color:#059669;"> 🟢  {{ auth()->user()->name }}   ({{ auth()->user()->role }})</div>
    </div>
    <ul class="nav flex-column" style="gap: 8px;">

        <li>
            <a href="/dashboard" class="menu-link">𝐃𝐚𝐬𝐡𝐛𝐨𝐚𝐫𝐝</a>
        </li>

        @if(auth()->user()->role == 'admin')
            <li><a href="/categories" class="menu-link">𝐂𝐚𝐭𝐞𝐠𝐨𝐫𝐢𝐞𝐬</a></li>
            <li><a href="/items" class="menu-link">𝐈𝐭𝐞𝐦𝐬</a></li>
            <li><a href="/lendings" class="menu-link">𝐋𝐞𝐧𝐝𝐢𝐧𝐠𝐬</a></li>
            <li><a href="/users" class="menu-link">𝐔𝐬𝐞𝐫𝐬</a></li>
        @endif

        @if(auth()->user()->role == 'staff')
            <li><a href="/items" class="menu-link">𝐈𝐭𝐞𝐦𝐬</a></li>
            <li><a href="/lendings" class="menu-link">𝐋𝐞𝐧𝐝𝐢𝐧𝐠</a></li>
            <li><a href="/users" class="menu-link">𝐔𝐬𝐞𝐫𝐬</a></li>
        @endif

        <li style="margin-top: 25px;">
            <form method="POST" action="/logout">
                @csrf
                <button class="logout-btn">
                    <span style="display:flex; align-items:center; justify-content:center; gap:8px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        Keluar
                    </span>
                </button>
            </form>
        </li>

    </ul>
</div>

    <!-- Content -->
    <div style="flex:1; padding: 30px; background: #ffffff;">
        @yield('content')
    </div>

</div>

<!-- STYLE -->
<style>
.menu-link {
    display: block;
    padding: 10px 14px;
    border-radius: 6px;
    color: #4b5563;
    text-decoration: none;
    font-size: 14px;
    transition: 0.2s ease;
}

/* Hover lebih halus */
.menu-link:hover {
    background: #fecaca;
    color: #dc2626;
}

/* Active lebih jelas tapi ga lebay */
.menu-link.active {
    background: #fee2e2;
    color: #dc2626;
}

/* Logout dirapihin dengan animasi */
.logout-btn {
    width: 100%;
    padding: 10px;
    background: linear-gradient(135deg, #dc2626, #b91c1c);
    border: none;
    border-radius: 8px;
    color: white;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

.logout-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s ease;
}

.logout-btn:hover {
    background: linear-gradient(135deg, #b91c1c, #991b1b);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
}

.logout-btn:hover::before {
    left: 100%;
}

.logout-btn:active {
    transform: translateY(0);
}

</style>

</body>
</html>