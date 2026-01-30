<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kades - Admin</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/styles.css']); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .form-container {
            margin-top: 30px;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-container input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-container button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo-container">
            <img src="<?php echo e(Vite::asset('resources/images/icon-tanggamus.png')); ?>" alt="Logo Kabupaten Tanggamus"
                class="logo-header">
            <div class="logo-text">
                <h1>Pekon Kunyayan</h1>
                <p>Kabupaten Tanggamus</p>
            </div>
        </div>
        <nav>
            <ul style="list-style: none; display: inline;">
                <li style="display: inline; margin-right: 10px;">
                    <a href="<?php echo e(route('admin.home')); ?>">Home</a>
                </li>
                <li style="display: inline; margin-right: 10px;">
                    <a href="<?php echo e(route('admin.kades.index')); ?>">Kades</a>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="form-container">

            <?php if(session('success')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <h1>Data Kades</h1>

            <!-- Tombol Tambah Data -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addKadesModal">
                Tambah Kades
            </button>

            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Foto</th>
                        <th>Tahun Jabatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $kades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($row->name); ?></td>
                            <td><img src="<?php echo e(asset('storage/' . $row->photo_url)); ?>" width="50"></td>
                            <td><?php echo e($row->tahun_jabatan); ?></td>
                            <td>
                                <!-- Tombol Edit (modal) -->
                                <button type="button" class="btn btn-warning btn-edit" data-bs-toggle="modal"
                                    data-bs-target="#editKadesModal" data-id="<?php echo e($row->id); ?>"
                                    data-name="<?php echo e($row->name); ?>"
                                    data-photo="<?php echo e(asset('storage/' . $row->photo_url)); ?>"
                                    data-tahun_jabatan="<?php echo e($row->tahun_jabatan); ?>"
                                    data-is_current="<?php echo e($row->is_current ? 1 : 0); ?>">
                                    Edit
                                </button>

                                <!-- Open full edit page -->
                                <a href="<?php echo e(route('admin.kades.edit', $row->id)); ?>" class="btn btn-secondary">Open Edit Page</a>

                                <!-- Tombol Hapus -->
                                <form action="<?php echo e(route('admin.kades.destroy', $row->id)); ?>" method="POST"
                                    class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            <!-- Modal Tambah Kades -->
            <div class="modal fade" id="addKadesModal" tabindex="-1" aria-labelledby="addKadesModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addKadesModalLabel">Tambah Kades</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo e(route('admin.kades.store')); ?>" method="POST"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="mb-3">
                                    <label>Nama Kades</label>
                                    <input type="text" name="name" class="form-control" required>
                                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="mb-3">
                                    <label>Foto</label>
                                    <img id="addPhotoPreview" width="100" class="d-block mb-2" style="display:none">
                                    <input type="file" name="photo" id="addPhoto" class="form-control" required>
                                    <?php $__errorArgs = ['photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="mb-3">
                                    <label>Tahun Jabatan</label>
                                    <input type="text" name="tahun_jabatan" class="form-control" required>
                                    <?php $__errorArgs = ['tahun_jabatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="hidden" name="is_current" value="0">
                                    <input type="checkbox" name="is_current" value="1" class="form-check-input" id="isCurrentAdd">
                                    <label class="form-check-label" for="isCurrentAdd">Kepala Pekon Saat Ini</label>
                                </div>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit Kades -->
            <div class="modal fade" id="editKadesModal" tabindex="-1" aria-labelledby="editKadesModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editKadesModalLabel">Edit Kades</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editKadesForm" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <input type="hidden" id="editId">
                                <div class="mb-3">
                                    <label>Nama Kades</label>
                                    <input type="text" id="editName" name="name" class="form-control" required>
                                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="mb-3">
                                    <label>Foto Saat Ini</label>
                                    <img id="editPhotoPreview" width="100" class="d-block mb-2">
                                    <label>Ganti Foto</label>
                                    <input type="file" name="photo" id="editPhoto" class="form-control">
                                    <?php $__errorArgs = ['photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="mb-3">
                                    <label>Tahun Jabatan</label>
                                    <input type="text" id="editTahunJabatan" name="tahun_jabatan"
                                        class="form-control" required>
                                    <?php $__errorArgs = ['tahun_jabatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="hidden" name="is_current" value="0">
                                    <input type="checkbox" id="editIsCurrent" name="is_current" value="1" class="form-check-input">
                                    <label class="form-check-label" for="editIsCurrent">Kepala Pekon Saat Ini</label>
                                </div>
                                <button type="submit" class="btn btn-success">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const editModal = document.getElementById("editKadesModal");
            editModal.addEventListener("show.bs.modal", function(event) {
                let button = event.relatedTarget;
                let id = button.getAttribute("data-id");
                let name = button.getAttribute("data-name");
                let photo = button.getAttribute("data-photo");
                let tahunJabatan = button.getAttribute("data-tahun_jabatan");
                let isCurrent = button.getAttribute("data-is_current");

                document.getElementById("editId").value = id;
                document.getElementById("editName").value = name;
                document.getElementById("editPhotoPreview").src = photo;
                document.getElementById("editTahunJabatan").value = tahunJabatan;
                document.getElementById("editIsCurrent").checked = isCurrent == '1';

                let form = document.getElementById("editKadesForm");
                form.action = "/admin/kades/" + id;
            });

            // Live preview for Add and Edit photo inputs
            const addPhotoInput = document.getElementById('addPhoto');
            const addPhotoPreview = document.getElementById('addPhotoPreview');
            if (addPhotoInput) {
                addPhotoInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (!file) { addPhotoPreview.style.display = 'none'; return; }
                    addPhotoPreview.src = URL.createObjectURL(file);
                    addPhotoPreview.style.display = 'block';
                });
            }

            const editPhotoInput = document.getElementById('editPhoto');
            const editPhotoPreview = document.getElementById('editPhotoPreview');
            if (editPhotoInput) {
                editPhotoInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (!file) { return; }
                    editPhotoPreview.src = URL.createObjectURL(file);
                });
            }
        });
    </script>
</body>

</html>
<?php /**PATH C:\Users\USER\Documents\GitHub\Desa-Kunyayan\resources\views/admin/kades/index.blade.php ENDPATH**/ ?>