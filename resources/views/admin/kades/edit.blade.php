<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kades - Admin</title>
    @vite(['resources/css/styles.css'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Edit Kepala Pekon</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.kades.update', $kades->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $kades->name) }}" required>
                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label>Foto Saat Ini</label><br>
                <img src="{{ asset('storage/' . $kades->photo_url) }}" width="150" class="mb-2">
                <div>
                    <label>Ganti Foto</label>
                    <input type="file" name="photo" class="form-control">
                    @error('photo') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="mb-3">
                <label>Tahun Jabatan</label>
                <input type="text" name="tahun_jabatan" class="form-control" value="{{ old('tahun_jabatan', $kades->tahun_jabatan) }}" required>
                @error('tahun_jabatan') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="hidden" name="is_current" value="0">
                <input type="checkbox" name="is_current" value="1" class="form-check-input" id="isCurrent" {{ $kades->is_current ? 'checked' : '' }}>
                <label class="form-check-label" for="isCurrent">Kepala Pekon Saat Ini</label>
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('admin.kades.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>