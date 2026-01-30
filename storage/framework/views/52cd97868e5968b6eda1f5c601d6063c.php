<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Berita - Admin</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/styles.css']); ?>
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
        .btn-danger {
            background-color: #e74c3c;
            color: white;
        }
        .btn-danger:hover {
            background-color: #c0392b;
        }
        .btn-small {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }
        .berita-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        .berita-table th {
            background-color: #40BFE1;
            color: white;
            padding: 1rem;
            text-align: left;
        }
        .berita-table td {
            padding: 1rem;
            border-bottom: 1px solid #eee;
        }
        .berita-table tr:hover {
            background-color: #f5f5f5;
        }
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }
        .empty-message {
            text-align: center;
            color: #999;
            padding: 3rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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
            <a href="<?php echo e(route('admin.home')); ?>">Dashboard</a>
            <a href="<?php echo e(route('admin.berita.index')); ?>" class="active">Kelola Berita</a>
            <a href="<?php echo e(route('admin.stats.edit')); ?>">Edit Infografis</a>
            <form action="<?php echo e(route('logout')); ?>" method="POST" style="margin-top: 2rem;">
                <?php echo csrf_field(); ?>
                <button type="submit" class="logout-btn" style="width: 100%; border: none; cursor: pointer; text-align: left;">Logout</button>
            </form>
        </div>

        <!-- Main Content -->
        <div class="admin-content">
            <div class="admin-header">
                <h1>Kelola Berita</h1>
                <a href="<?php echo e(route('admin.berita.create')); ?>" class="btn btn-primary">+ Tambah Berita</a>
            </div>

            <?php if(session('success')): ?>
                <div style="background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 1rem; border-radius: 5px; margin-bottom: 1rem;">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <?php if($beritas->count() > 0): ?>
                <table class="berita-table">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Tanggal</th>
                            <th>Dibaca</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $beritas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $berita): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(Str::limit($berita->title, 50)); ?></td>
                                <td><?php echo e($berita->author); ?></td>
                                <td><?php echo e($berita->created_at->translatedFormat('d M Y')); ?></td>
                                <td><?php echo e($berita->views); ?></td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="<?php echo e(route('admin.berita.edit', $berita->id)); ?>" class="btn btn-primary btn-small">Edit</a>
                                        <form action="<?php echo e(route('admin.berita.destroy', $berita->id)); ?>" method="POST" style="display: inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger btn-small" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-message">
                    <p>Belum ada berita. <a href="<?php echo e(route('admin.berita.create')); ?>" style="color: #40BFE1;">Buat berita baru</a></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\USER\Documents\GitHub\Desa-Kunyayan\resources\views/admin/berita/index.blade.php ENDPATH**/ ?>