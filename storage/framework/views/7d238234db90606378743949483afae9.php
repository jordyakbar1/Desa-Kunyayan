<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mitigasi Bencana - Pekon Kunyayan</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/styles.css')); ?>">
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
                <li>
                    <a href="<?php echo e(route('berita.index')); ?>" class="<?php echo e(Request::is('berita') ? 'active' : ''); ?>">Berita</a>
                </li>
                <?php if(auth()->guard()->check()): ?>
                    <?php if(auth()->user()->hasRole('admin')): ?>
                        <li>
                            <a href="<?php echo e(route('admin.home')); ?>" class="<?php echo e(Request::is('admin/home') ? 'active' : ''); ?>">Dashboard</a>
                        </li>
                        <li>
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="logout-button">
                                    Logout
                                </button>
                            </form>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </nav>
    </header>


    <main class="mitigasi-content">
        <section class="mitigasi-header">
            <h1>MITIGASI BENCANA</h1>
            <h2>PEKON KUNYAYAN</h2>
        </section>

        <section class="disaster-map">
            <h3>Peta Rawan Bencana Pekon Kunyayan</h3>
            <div class="map-container">
                <img src="<?php echo e(Vite::asset('resources/images/icon-peta_bencana.png')); ?>">
                <p><b>Analisis Kebencanaan Pekon Kunyayan</b></p>
                <p>Pekon Kunyayan memiliki dua kategori kawasan rawan bencana,
                    yaitu rawan bencana tinggi dan sedang, sebagaimana terlihat di peta.
                    Kawasan rawan bencana sedang berada di wilayah permukiman, sehingga
                    membutuhkan perhatian lebih untuk melindungi penduduk dan infrastruktur.
                    Sementara itu, kawasan rawan bencana tinggi terletak di daerah perkebunan,
                    yang memerlukan strategi mitigasi untuk mengurangi kerugian ekonomi dan
                    menjaga keberlanjutan kegiatan perkebunan. Pembagian ini penting untuk
                    menentukan prioritas dalam upaya mitigasi dan perencanaan wilayah yang lebih aman.</p>
            </div>
            <!-- <h3>Analisis Kebencanaan Pekon Kunyayan</h3> -->
        </section>

        <section class="evacuation">
            <h3>Jalur Evakuasi</h3>
            <div class="evacuation-map">
                <img src="<?php echo e(Vite::asset('resources/images/peta-jalur-evakuasi.png')); ?>">
            </div>
        </section>

        <section class="guide-section">
            <h4>Panduan Mitigasi Bencana Gempa</h4>
                <div class="guide-grid">
                    <div class="guide-card">
                        <div class="guide-icon">
                            <img src="<?php echo e(Vite::asset('resources/images/icon-mitigasi1.png')); ?>">
                        </div>
                        <p>Tetap Tenang dan Jangan Panik</p>
                    </div>
                    <div class="guide-card">
                        <div class="guide-icon">
                            <img src="<?php echo e(Vite::asset('resources/images/icon-mitigasi2.png')); ?>">
                        </div>
                        <p>Berlindung di bawah meja yang kokoh</p>
                    </div>
                    <div class="guide-card">
                        <div class="guide-icon">
                            <img src="<?php echo e(Vite::asset('resources/images/icon-mitigasi3.png')); ?>">
                        </div>
                        <p>Jauhi Benda Berbahaya</p>
                    </div>
                    <div class="guide-card">
                        <div class="guide-icon">
                            <img src="<?php echo e(Vite::asset('resources/images/icon-mitigasi4.png')); ?>">
                        </div>
                        <p>Jangan Gunakan Lift</p>
                    </div>
                    <div class="guide-card">
                        <div class="guide-icon">
                            <img src="<?php echo e(Vite::asset('resources/images/icon-mitigasi5.png')); ?>">
                        </div>
                        <p>Cari Tempat Terbuka</p>
                    </div>
                    <div class="guide-card">
                        <div class="guide-icon">
                            <img src="<?php echo e(Vite::asset('resources/images/icon-mitigasi6.png')); ?>">
                        </div>
                        <p>Waspadai Gempa Susulan</p>
                    </div>
                </div>

            <h4>Panduan Mitigasi Bencana Tanah Longsor</h4>
                <div class="guide-grid">
                    <div class="guide-card">
                        <div class="guide-icon">
                            <img src="<?php echo e(Vite::asset('resources/images/icon-mitigasi1.png')); ?>">
                        </div>
                        <p>Tetap Tenang dan Perhatikan Sekitar</p>
                    </div>
                    <div class="guide-card">
                        <div class="guide-icon">
                            <img src="<?php echo e(Vite::asset('resources/images/icon-mitigasi8.png')); ?>">
                        </div>
                        <p>Segera Menjauhi Area Longsor</p>
                    </div>
                    <div class="guide-card">
                        <div class="guide-icon">
                            <img src="<?php echo e(Vite::asset('resources/images/icon-mitigasi7.png')); ?>">
                        </div>
                        <p>Lindungi Kepala & Tubuh</p>
                    </div>
                    <div class="guide-card">
                        <div class="guide-icon">
                            <img src="<?php echo e(Vite::asset('resources/images/icon-mitigasi9.png')); ?>">
                        </div>
                        <p>Hindari Sungai & Lembah Curam</p>
                    </div>
                    <div class="guide-card">
                        <div class="guide-icon">
                            <img src="<?php echo e(Vite::asset('resources/images/icon-mitigasi10.png')); ?>">
                        </div>
                        <p>Waspadai Longsor Susulan</p>
                    </div>
                    <div class="guide-card">
                        <div class="guide-icon">
                            <img src="<?php echo e(Vite::asset('resources/images/icon-mitigasi11.png')); ?>">
                        </div>
                        <p>Ikuti Informasi Resmi</p>
                    </div>
                </div>
        </section>

        <section class="education-video">
            <h3>Video Edukasi Mitigasi Bencana</h3>
            <div class="video-container">
            <iframe src="https://www.youtube.com/embed/DeafytS3Rjw?si=DqqZSrAFJ3yZltiD"
                    title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media;
                    gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        </section>
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
<?php /**PATH C:\Users\USER\Documents\GitHub\Desa-Kunyayan\resources\views/mitigasi.blade.php ENDPATH**/ ?>