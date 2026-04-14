<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris</title>
    @vite(['resources/css/app.css','resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>

<body style="font-family: 'Inter', sans-serif; background: #0f172a; color: #e5e7eb;">

<div class="d-flex">

    <!-- Sidebar -->
    <div style="
        width: 260px;
        background: #020617;
        border-right: 1px solid rgba(255,255,255,0.05);
        min-height: 100vh;
        padding: 24px;
    ">

        <h5 style="font-weight: 600; margin-bottom: 30px; color: #fff;">
            Inventaris
        </h5>

        <ul class="nav flex-column" style="gap: 6px;">

            <li>
                <a href="/dashboard" class="menu-link">Dashboard</a>
            </li>

            @if(auth()->user()->role == 'admin')
                <li><a href="/categories" class="menu-link">Categories</a></li>
                <li><a href="/items" class="menu-link">Items</a></li>
                <li><a href="/lendings" class="menu-link">Lendings</a></li>
                <li><a href="/users" class="menu-link">Users</a></li>
            @endif

            @if(auth()->user()->role == 'staff')
                <li><a href="/items" class="menu-link">Items</a></li>
                <li><a href="/lendings" class="menu-link">Lending</a></li>
                <li><a href="/users" class="menu-link">Users</a></li>
            @endif

            <li style="margin-top: 30px;">
                <form method="POST" action="/logout">
                    @csrf
                    <button style="
                        width: 100%;
                        padding: 10px;
                        background: #ff01018c;
                        border: none;
                        border-radius: 8px;
                        color: white;
                        font-weight: 500;
                    ">
                        Keluar
                    </button>
                </form>
            </li>

        </ul>
    </div>

    <!-- Content -->
    <div style="flex:1; padding: 30px;">
        @yield('content')
    </div>

</div>

<!-- STYLE -->
<style>
.menu-link {
    display: block;
    padding: 10px 14px;
    border-radius: 8px;
    color: #94a3b8;
    text-decoration: none;
    font-size: 14px;
    transition: 0.2s;
}

.menu-link:hover {
    background: rgba(59,130,246,0.15);
    color: #60a5fa;
}

.menu-link.active {
    background: rgba(59,130,246,0.2);
    color: #3b82f6;
}
</style>

</body>
</html>