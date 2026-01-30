<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Pekon Kunyayan</title>
    @vite(['resources/css/styles.css'])
    <style>
        body {
            background-color: #f5f5f5;
        }
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }
        .admin-sidebar {
            width: 250px;
            background-color: #40BFE1;
            padding: 2rem 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }
        .admin-sidebar h3 {
            color: white;
            padding: 0 1.5rem;
            margin-bottom: 2rem;
            font-size: 1.5rem;
        }
        .admin-sidebar a {
            display: block;
            color: white;
            padding: 1rem 1.5rem;
            text-decoration: none;
            border-left: 4px solid transparent;
            transition: all 0.3s;
        }
        .admin-sidebar a:hover,
        .admin-sidebar a.active {
            background-color: rgba(255,255,255,0.1);
            border-left-color: white;
        }
        .admin-content {
            margin-left: 250px;
            padding: 2rem;
            flex: 1;
        }
        .admin-header {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        .admin-header h1 {
            color: #40BFE1;
            margin: 0;
        }
        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        .card {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        .card h3 {
            color: #40BFE1;
            font-size: 2rem;
            margin: 0;
        }
        .card p {
            color: #666;
            margin: 0.5rem 0 0 0;
        }
        .logout-btn {
            background-color: #e74c3c;
            color: white !important;
            margin-top: 2rem;
        }
        .logout-btn:hover {
            background-color: #c0392b !important;
        }
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <div class="admin-sidebar">
            <h3>Admin Panel</h3>
            <a href="{{ route('admin.home') }}" class="active">Dashboard</a>
            <a href="{{ route('admin.berita.index') }}">Kelola Berita</a>
            <a href="{{ route('admin.kades.index') }}">Kelola Kepala Pekon</a>
            <a href="{{ route('admin.stats.edit') }}">Edit Infografis</a>
            <form action="{{ route('logout') }}" method="POST" style="margin-top: 2rem;">
                @csrf
                <button type="submit" class="logout-btn" style="width: 100%; border: none; cursor: pointer; text-align: left;">Logout</button>
            </form>
        </div>

        <!-- Main Content -->
        <div class="admin-content">
            <div class="admin-header">
                <h1>Dashboard Admin</h1>
                <p>Selamat datang, {{ auth()->user()->name }}</p>
            </div>

            <div class="dashboard-cards">
                <div class="card">
                    <h3>{{ $total_beritas }}</h3>
                    <p>Total Berita</p>
                </div>
                <div class="card">
                    <h3>{{ $total_views }}</h3>
                    <p>Total Dibaca</p>
                </div>
            </div>

            <div style="background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                <h2 style="color: #40BFE1; margin-top: 0;">Fitur Management</h2>
                <ul style="list-style: none; padding: 0;">
                    <li><a href="{{ route('admin.berita.index') }}" style="color: #40BFE1; text-decoration: none; font-weight: bold;">→ Kelola Berita</a></li>
                    <li><a href="{{ route('admin.kades.index') }}" style="color: #40BFE1; text-decoration: none; font-weight: bold;">→ Kelola Kepala Pekon</a></li>
                    <li><a href="{{ route('admin.stats.edit') }}" style="color: #40BFE1; text-decoration: none; font-weight: bold;">→ Edit Data Infografis</a></li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
