<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pekon - Pekon Kunyayan</title>
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
                            <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    
    <?php if(auth()->guard()->check()): ?>
        <?php if(auth()->user()->hasRole('admin')): ?>
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                <?php echo csrf_field(); ?>
            </form>
        <?php endif; ?>
    <?php endif; ?>


    <main class="profile-content">
        <!-- Visi Section -->
        <section class="visi-section">
            <div class="visi-card">
                <h2 class="section-title" style="color: #40BFE1;">Visi</h2>
                <p class="visi-text">Dengan Ridho ALLAH SWT Bersama-sama masyarakat demi terbangunnya tata kelola pemerintahan pekon Kunyayan yang baik dan bersih guna mewujudkan pekon kunyayan yang adil, makmur dengan iman dan takwa serta bermanfaat.</p>
            </div>
        </section>

        <!-- Misi Section -->
        <section class="misi-section">
            <div class="misi-card">
                <h2 class="section-title" style="color: #40BFE1;">Misi</h2>
                <p class="misi-text">Menyelenggarakan pemerintahan pekon yang bersih demokratis dan terbebas dari korupsi, kolusi, dan nepotisme (KKN) serta bentuk penyelewengan lainnya.</p>
            </div>
        </section>

        <!-- Bagan Desa Section -->
        <section class="bagan-desa-section">
            <h2 class="section-title main-title" style="color: #40BFE1;">Bagan Desa</h2>
            <div class="bagan-container">
                <div class="bagan-item">
                    <h3>Struktur Organisasi Pemerintahan Desa</h3>
                    <img src="<?php echo e(Vite::asset('resources/images/icon-pekon.png')); ?>" alt="Struktur Organisasi Pemerintahan Desa" class="bagan-image">
                </div>
                <div class="bagan-item">
                    <h3>Struktur Organisasi BHP Pekon Kunyayan</h3>
                    <img src="<?php echo e(Vite::asset('resources/images/icon-bhp.png')); ?>" alt="Struktur Organisasi BHP" class="bagan-image">
                </div>
                <div class="bagan-item">
                    <h3>Struktur Organisasi LPM Pekon Kunyayan</h3>
                    <img src="<?php echo e(Vite::asset('resources/images/icon-lpm.png')); ?>" alt="Struktur Organisasi LPM" class="bagan-image">
                </div>
            </div>
        </section>

        <!-- Peta Lokasi Section -->
        <section class="peta-lokasi-section">
            <h2 class="section-title main-title" style="color: #40BFE1;">Peta Lokasi Desa</h2>
            <div class="peta-lokasi-container">
                <div class="peta-info">
                    <div class="info-box">
                        <h3>Batas Desa:</h3>
                        <div class="info-grid">
                            <div class="info-item">
                                <strong>Utara</strong>
                                <p>Negeri Ngarip</p>
                            </div>
                            <div class="info-item">
                                <strong>Timur</strong>
                                <p>Pekon Balak</p>
                            </div>
                            <div class="info-item">
                                <strong>Selatan</strong>
                                <p>Pekon Balak</p>
                            </div>
                            <div class="info-item">
                                <strong>Barat</strong>
                                <p>Banjar Sari</p>
                            </div>
                        </div>
                    </div>

                    <div class="info-box">
                        <h3>Luas Desa:</h3>
                        <p class="info-value">730.000.000 m²</p>
                    </div>

                    <div class="info-box">
                        <h3>Jumlah Penduduk</h3>
                        <p class="info-value">1.361 Jiwa</p>
                    </div>
                </div>
                <div class="peta-map">
                    <img src="<?php echo e(Vite::asset('resources/images/icon-peta_bencana.png')); ?>" alt="Peta Lokasi Desa" class="map-image">
                </div>
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

</html>
<?php /**PATH C:\Users\USER\Documents\GitHub\Desa-Kunyayan\resources\views/profil.blade.php ENDPATH**/ ?>