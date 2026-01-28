<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Berita - Admin</title>
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
            display: flex;
            justify-content: space-between;
            align-items: center;
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
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-family: inherit;
            font-size: 1rem;
            box-sizing: border-box;
        }
        .form-group textarea {
            resize: vertical;
            min-height: 200px;
        }
        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
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
        }
        .btn-primary:hover {
            background-color: #2da9cc;
        }
        .btn-secondary {
            background-color: #999;
            color: white;
        }
        .btn-secondary:hover {
            background-color: #777;
        }
        .button-group {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }
        .error-message {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
        }
        .image-preview {
            margin-top: 0.5rem;
            max-width: 200px;
        }
        .image-preview img {
            width: 100%;
            border-radius: 5px;
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
            <a href="{{ route('admin.home') }}">Dashboard</a>
            <a href="{{ route('admin.berita.index') }}" class="active">Kelola Berita</a>
            <a href="{{ route('admin.stats.edit') }}">Edit Infografis</a>
            <form action="{{ route('logout') }}" method="POST" style="margin-top: 2rem;">
                @csrf
                <button type="submit" class="logout-btn" style="width: 100%; border: none; cursor: pointer; text-align: left;">Logout</button>
            </form>
        </div>

        <!-- Main Content -->
        <div class="admin-content">
            <div class="admin-header">
                <h1>Tambah Berita Baru</h1>
            </div>

            @if ($errors->any())
                <div class="error-message">
                    <strong>Terjadi kesalahan:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-container">
                <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="title">Judul Berita</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="content">Isi Berita</label>
                        <textarea id="content" name="content" required>{{ old('content') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="author">Penulis</label>
                        <input type="text" id="author" name="author" value="{{ old('author', auth()->user()->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="image_url">Foto Berita</label>
                        <input type="file" id="image_url" name="image_url" accept="image/*">
                        <div id="preview"></div>
                    </div>

                    <div class="button-group">
                        <button type="submit" class="btn btn-primary">Simpan Berita</button>
                        <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('image_url').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('preview');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `<div class="image-preview"><img src="${e.target.result}" alt="Preview"></div>`;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>

