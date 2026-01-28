<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Infografis - Admin</title>
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
        .form-container {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #333;
        }
        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            box-sizing: border-box;
        }
        .form-group input:focus {
            outline: none;
            border-color: #40BFE1;
            box-shadow: 0 0 0 3px rgba(64, 191, 225, 0.1);
        }
        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            text-decoration: none;
            display: inline-block;
        }
        .btn-primary {
            background-color: #40BFE1;
            color: white;
            margin-top: 1rem;
        }
        .btn-primary:hover {
            background-color: #2da9cc;
        }
        .success-message {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
        }
        .logout-btn {
            background-color: #e74c3c;
            color: white !important;
            margin-top: 2rem;
        }
        .logout-btn:hover {
            background-color: #c0392b !important;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 2rem;
        }
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <div class="admin-sidebar">
            <h3>Admin Panel</h3>
            <a href="{{ route('admin.home') }}">Dashboard</a>
            <a href="{{ route('admin.berita.index') }}">Kelola Berita</a>
            <a href="{{ route('admin.stats.edit') }}" class="active">Edit Infografis</a>
            <form action="{{ route('logout') }}" method="POST" style="margin-top: 2rem;">
                @csrf
                <button type="submit" class="logout-btn" style="width: 100%; border: none; cursor: pointer; text-align: left;">Logout</button>
            </form>
        </div>

        <!-- Main Content -->
        <div class="admin-content">
            <div class="admin-header">
                <h1>Edit Infografis</h1>
            </div>

            @if (session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif

            <div class="form-container">
                <h3 style="color: #40BFE1; margin-top: 0;">Ubah Data Statistik Pekon Kunyayan</h3>
                
                <form action="{{ route('admin.stats.update') }}" method="POST">
                    @csrf

                    <div class="stats-grid">
                        <div class="form-group">
                            <label for="total_population">Total Populasi</label>
                            <input type="number" id="total_population" name="total_population" value="{{ $statistic->total_population ?? 0 }}" required>
                        </div>

                        <div class="form-group">
                            <label for="total_families">Total Kepala Keluarga</label>
                            <input type="number" id="total_families" name="total_families" value="{{ $statistic->total_families ?? 0 }}" required>
                        </div>

                        <div class="form-group">
                            <label for="total_males">Total Laki-laki</label>
                            <input type="number" id="total_males" name="total_males" value="{{ $statistic->total_males ?? 0 }}" required>
                        </div>

                        <div class="form-group">
                            <label for="total_females">Total Perempuan</label>
                            <input type="number" id="total_females" name="total_females" value="{{ $statistic->total_females ?? 0 }}" required>
                        </div>
                    </div>

                    <h3 style="color: #40BFE1; margin-top: 2rem;">Berdasarkan Agama</h3>
                    
                    <div class="stats-grid">
                        <div class="form-group">
                            <label for="islam">Islam</label>
                            <input type="number" id="islam" name="islam" value="{{ $statistic->islam ?? 0 }}" required>
                        </div>

                        <div class="form-group">
                            <label for="christian">Kristiani</label>
                            <input type="number" id="christian" name="christian" value="{{ $statistic->christian ?? 0 }}" required>
                        </div>

                        <div class="form-group">
                            <label for="catholic">Katolik</label>
                            <input type="number" id="catholic" name="catholic" value="{{ $statistic->catholic ?? 0 }}" required>
                        </div>

                        <div class="form-group">
                            <label for="hindu">Hindu</label>
                            <input type="number" id="hindu" name="hindu" value="{{ $statistic->hindu ?? 0 }}" required>
                        </div>

                        <div class="form-group">
                            <label for="buddha">Buddha</label>
                            <input type="number" id="buddha" name="buddha" value="{{ $statistic->buddha ?? 0 }}" required>
                        </div>

                        <div class="form-group">
                            <label for="konghucu">Konghucu</label>
                            <input type="number" id="konghucu" name="konghucu" value="{{ $statistic->konghucu ?? 0 }}" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Infografis</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
