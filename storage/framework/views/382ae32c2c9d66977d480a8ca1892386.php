<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita - Pekon Kunyayan</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/styles.css']); ?>
    <style>
        .berita-content {
            max-width: 900px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .berita-header {
            margin-bottom: 40px;
        }

        .berita-header h1 {
            color: #40BFE1;
            font-size: 2.5rem;
            margin: 0 0 15px 0;
        }

        .berita-header p {
            color: #666;
            font-size: 1rem;
            line-height: 1.6;
        }

        .berita-list {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .berita-card {
            background: #f9f9f9;
            padding: 25px;
            border-radius: 8px;
            border-left: 4px solid #40BFE1;
            transition: all 0.3s ease;
        }

        .berita-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .berita-title {
            color: #333;
            font-size: 1.4rem;
            margin: 0 0 12px 0;
            cursor: pointer;
            text-decoration: none;
        }

        .berita-title a {
            color: #333;
            text-decoration: none;
        }

        .berita-title a:hover {
            color: #40BFE1;
        }

        .berita-excerpt {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.6;
            margin: 0 0 15px 0;
        }

        .berita-meta {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 10px;
            font-size: 0.9rem;
        }

        .berita-author {
            color: #333;
            font-weight: 600;
        }

        .berita-views {
            color: #999;
        }

        .berita-date {
            color: #999;
            font-size: 0.9rem;
        }

        .empty-message {
            text-align: center;
            padding: 40px;
            color: #999;
        }

        @media (max-width: 768px) {
            .berita-content {
                padding: 20px 10px;
            }

            .berita-header h1 {
                font-size: 2rem;
            }

            .berita-card {
                padding: 20px;
            }

            .berita-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }
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

    <main class="berita-content">
        <section class="berita-header">
            <h1>Berita Desa</h1>
            <p>Menyajikan informasi terbaru tentang peristiwa, berita terkini, dan artikel-artikel jurnalistik dari Pekon Kunyayan</p>
        </section>

        <section class="berita-list">
            <?php $__empty_1 = true; $__currentLoopData = $beritas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $berita): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <article class="berita-card">
                    <?php if($berita->image_url): ?>
                        <div style="margin-bottom: 15px; border-radius: 6px; overflow: hidden;">
                            <img src="<?php echo e(asset('storage/' . $berita->image_url)); ?>" alt="<?php echo e($berita->title); ?>" style="width: 100%; height: 250px; object-fit: cover;">
                        </div>
                    <?php endif; ?>
                    <h2 class="berita-title">
                        <a href="<?php echo e(route('berita.show', $berita->id)); ?>"><?php echo e($berita->title); ?></a>
                    </h2>
                    <p class="berita-excerpt"><?php echo e(Str::limit($berita->content, 200)); ?></p>
                    <div class="berita-meta">
                        <span class="berita-author"><?php echo e($berita->author); ?></span>
                        <span class="berita-views">Dibaca <?php echo e($berita->views); ?> kali</span>
                    </div>
                    <div class="berita-date">
                        <?php echo e($berita->created_at->translatedFormat('d M Y')); ?>

                    </div>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="empty-message">
                    <p>Belum ada berita. Silahkan kembali lagi nanti.</p>
                </div>
            <?php endif; ?>
        </section>

        <?php if($beritas->hasPages()): ?>
            <div style="margin-top: 30px; text-align: center;">
                <?php echo e($beritas->links()); ?>

            </div>
        <?php endif; ?>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <img src="<?php echo e(Vite::asset('resources/images/icon-tanggamus.png')); ?>" alt="Logo Kabupaten Tanggamus"
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
                <p><img src="<?php echo e(Vite::asset('resources/images/icon-phonecall.png')); ?>" alt="Phone"> 085378033300
                </p>
                <p><img src="<?php echo e(Vite::asset('resources/images/icon-mail.png')); ?>" alt="Email">
                    kunayannnkunayan@gmail.com</p>
                <p><img src="<?php echo e(Vite::asset('resources/images/icon-clock.png')); ?>" alt="Clock"> Senin - Jum'at
                    (08.00 - 15.00)</p>
                <p><img src="<?php echo e(Vite::asset('resources/images/icon-pin.png')); ?>" alt="Location"> Jl. Lintas Barat
                    Pekon Kunyayan Kecamatan Wonosobo</p>
            </div>
        </div>
    </footer>

    <?php if(auth()->guard()->check()): ?>
        <?php if(auth()->user()->hasRole('admin')): ?>
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                <?php echo csrf_field(); ?>
            </form>
        <?php endif; ?>
    <?php endif; ?>
</body>

</html>
<?php /**PATH C:\Users\USER\Documents\GitHub\Desa-Kunyayan\resources\views/berita_index.blade.php ENDPATH**/ ?>