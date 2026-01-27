<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pekon Kunyayan - Kabupaten Tanggamus</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/styles.css']); ?>


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
            <ul>
                <li>
                    <a href="<?php echo e(route('home')); ?>"
                        class="<?php echo e(Request::is('/') || Request::is('home') ? 'active' : ''); ?>">Home</a>
                </li>
                <li>
                    <a href="<?php echo e(route('profil')); ?>" class="<?php echo e(Request::is('profil') ? 'active' : ''); ?>">Profil Pekon</a>
                </li>
                <li>
                    <a href="<?php echo e(route('infografis')); ?>"
                        class="<?php echo e(Request::is('infografis') ? 'active' : ''); ?>">Infografis</a>
                </li>
                <li>
                    <a href="<?php echo e(route('mitigasi')); ?>" class="<?php echo e(Request::is('mitigasi') ? 'active' : ''); ?>">Mitigasi
                        Bencana</a>
                </li>
                <?php if(auth()->guard()->check()): ?>
                    <?php if(auth()->user()->hasRole('admin')): ?>
                        <li>
                            <a href="<?php echo e(route('admin.home')); ?>"
                                class="<?php echo e(Request::is('admin/home') ? 'active' : ''); ?>">Dashboard</a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('admin.stats.edit')); ?>"
                                class="<?php echo e(Request::is('admin/stats/edit') ? 'active' : ''); ?>">Edit Stats</a>
                        </li>
                        <li style="display: inline; margin-right: 10px;">
                            <a href="<?php echo e(route('admin.kades.index')); ?>">Kades</a>
                        </li>
                        <li style="display: inline; margin-right: 10px;">
                            <a href="<?php echo e(route('admin.berita.index')); ?>">Berita</a>
                        </li>
                    <?php endif; ?>
                    <li>
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="logout-button">
                                Logout
                            </button>
                        </form>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="<?php echo e(route('login')); ?>">Log in</a>
                    </li>
                    <?php if(Route::has('register')): ?>
                        <li>
                            <a href="<?php echo e(route('register')); ?>">Register</a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </nav>
    </header>


    <main>
        <section class="infografis">
            <h1>INFOGRAFIS</h1>
            <h2>PEKON KUNYAYAN</h2>

            <!-- Display success message -->
            <?php if(session('success')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <h4>Informasi Geografis</h4>
            <div class="geographic-info">
                <div class="geo-grid">
                    <div class="geo-card">
                        <h4>Informasi wilayah</h4>
                        <div class="geo-item">
                            <span>Luas</span>
                            <span>890 Hektar</span>
                        </div>
                        <div class="geo-item">
                            <span>Koordinat</span>
                            <span>-5.4525, 104.5149</span>
                        </div>
                    </div>
                </div>
                <div class="geo-card">
                    <h4>Batas Wilayah</h4>
                    <div class="geo-details">
                        <div class="geo-item">
                            <span>Utara</span>
                            <span>Negeri Ngarip</span>
                        </div>
                        <div class="geo-item">
                            <span>Timur</span>
                            <span>Pekon Balak</span>
                        </div>
                        <div class="geo-item">
                            <span>Barat</span>
                            <span>Banjar Sari</span>
                        </div>
                        <div class="geo-item">
                            <span>Selatan</span>
                            <span>Pekon Balak</span>
                        </div>
                    </div>
                </div>
            </div>

            <h4>Jumlah Penduduk dan Kepala Keluarga</h4>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="icon-container">
                        <img src="<?php echo e(Vite::asset('resources/images/icon-ppl.png')); ?>" alt="Total Penduduk">
                    </div>
                    <div class="stat-info">
                        <h5>Total Penduduk</h5>
                        <p><?php echo e($statistic->total_population ?? 0); ?></p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="icon-container">
                        <img src="<?php echo e(Vite::asset('resources/images/icon-fam.png')); ?>" alt="Kepala Keluarga">
                    </div>
                    <div class="stat-info">
                        <h5>Kepala Keluarga</h5>
                        <p><?php echo e($statistic->total_families ?? 0); ?></p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="icon-container">
                        <img src="<?php echo e(Vite::asset('resources/images/icon-man.png')); ?>" alt="Laki-laki">
                    </div>
                    <div class="stat-info">
                        <h5>Laki-laki</h5>
                        <p><?php echo e($statistic->total_males ?? 0); ?></p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="icon-container">
                        <img src="<?php echo e(Vite::asset('resources/images/icon-woman.png')); ?>" alt="perempuan">
                    </div>
                    <div class="stat-info">
                        <h5>Perempuan</h5>
                        <p><?php echo e($statistic->total_females ?? 0); ?></p>
                    </div>
                </div>
            </div>

            <h4>Berdasarkan Agama</h4>
            <div class="religion-grid">
                <div class="religion-card">
                    <h5>Islam</h5>
                    <p><?php echo e($statistic->islam ?? 0); ?></p>
                </div>
                <div class="religion-card">
                    <h5>Kristen</h5>
                    <p><?php echo e($statistic->christian ?? 0); ?></p>
                </div>
                <div class="religion-card">
                    <h5>Katholik</h5>
                    <p><?php echo e($statistic->catholic ?? 0); ?></p>
                </div>
                <div class="religion-card">
                    <h5>Hindu</h5>
                    <p><?php echo e($statistic->hindu ?? 0); ?></p>
                </div>
                <div class="religion-card">
                    <h5>Budha</h5>
                    <p><?php echo e($statistic->buddha ?? 0); ?></p>
                </div>
                <div class="religion-card">
                    <h5>Kong hu chu</h5>
                    <p><?php echo e($statistic->konghucu ?? 0); ?></p>
                </div>
            </div>

    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <img src="<?php echo e(Vite::asset('resources/images/icon-tanggamus.png')); ?> " alt="Logo Kabupaten Tanggamus"
                    class="logo">
                <div class="footer-text">
                    <h3>Pekon Kunyayan</h3>
                    <p>Kecamatan Wonosobo</p>
                    <p>Kabupaten Tanggamus</p>
                    <p>Provinsi Lampung</p>
                </div>
            </div>
            <div class="contact-info">
                <h3>Kontak Pekon</h3>
                <p><img src="<?php echo e(Vite::asset('resources/images/icon-phonecall.png')); ?>" alt="Phone"> 085378033300</p>
                <p><img src="<?php echo e(Vite::asset('resources/images/icon-mail.png')); ?>" alt="Email">
                    kunayannnkunayan@gmail.com</p>
                <p><img src="<?php echo e(Vite::asset('resources/images/icon-clock.png')); ?>" alt="Clock"> Senin - Jum'at
                    (08.00 - 15.00)</p>
                <p><img src="<?php echo e(Vite::asset('resources/images/icon-pin.png')); ?>" alt="Location"> Jl. Lintas Barat Pekon
                    Kunyayan Kecamatan Wonosobo</p>
            </div>
        </div>
    </footer>
</body>

</html>
<?php /**PATH C:\Users\USER\Documents\GitHub\Desa-Kunyayan\resources\views/infografis.blade.php ENDPATH**/ ?>