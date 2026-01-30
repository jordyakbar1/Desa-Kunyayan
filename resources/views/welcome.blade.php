<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pekon Kunyayan - Kabupaten Tanggamus</title>
    @vite(['resources/css/styles.css', 'resources/css/carousel.css'])
    <style>
        /* Change the color of the carousel control arrows to black */
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: black;
        }

        /* Change the color of the carousel indicators (dots) to black */
        .carousel-indicators li {
            background-color: black;
        }

        /* Optionally, change the color of the active indicator dot */
        .carousel-indicators .active {
            background-color: #333;
            /* Darker black for active dot */
        }
    </style>
</head>

<body class="antialiased">
    <header>
        <div class="logo-container">
            <img src="{{ Vite::asset('resources/images/icon-tanggamus.png') }}" alt="Logo Kabupaten Tanggamus"
                class="logo-header">
            <div class="logo-text">
                <h1>Pekon Kunyayan</h1>
                <p>Kabupaten Tanggamus</p>
            </div>
        </div>
        <nav>
            <ul>
                <li>
                    <a href="{{ route('home') }}"
                        class="{{ Request::is('/') || Request::is('home') ? 'active' : '' }}">Home</a>
                </li>
                <li>
                    <a href="{{ route('profil') }}" class="{{ Request::is('profil') ? 'active' : '' }}">Profil Pekon</a>
                </li>
                <li>
                    <a href="{{ route('infografis') }}"
                        class="{{ Request::is('infografis') ? 'active' : '' }}">Infografis</a>
                </li>
                <li>
                    <a href="{{ route('mitigasi') }}" class="{{ Request::is('mitigasi') ? 'active' : '' }}">Mitigasi
                        Bencana</a>
                </li>
                <li>
                    <a href="{{ route('berita.index') }}" class="{{ Request::is('berita') ? 'active' : '' }}">Berita</a>
                </li>
                <!-- Small goto/search bar for quick navigation (type '/login' then Enter) -->
                <li style="display:inline; margin-left:10px;">
                    <form id="gotoForm" onsubmit="event.preventDefault(); var v = document.getElementById('gotoInput').value.trim(); if (!v) return; if (!v.startsWith('/')) v = '/' + v; window.location.href = v;" style="display:inline;">
                        <input id="gotoInput" type="text" placeholder="Type '/login' then Enter" style="padding:4px; border-radius:4px;"> 
                    </form>
                </li>
                @auth
                    @if (auth()->user()->hasRole('admin'))
                        <li>
                            <a href="{{ route('admin.home') }}" class="{{ Request::is('admin/home') ? 'active' : '' }}">Dashboard</a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="logout-button">
                                    Logout
                                </button>
                            </form>
                        </li>
                    @endif
                @endauth
            </ul>
        </nav>

    </header>
    <main>
        <section class="hero">
            <div class="slider">
                <h2>Selamat Datang di<br>Website Pekon Kunyayan</h2>
            </div>
        </section>

        <section class="news">
            <h2 class="h2 mb-4">Aktivitas Desa</h2>
            <div id="newsCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($beritas->chunk(3) as $chunkIndex => $beritaChunk)
                        <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                            <div class="row">
                                @foreach ($beritaChunk as $berita)
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <a href="{{ route('berita.show', $berita->id) }}"
                                            class="news-card text-decoration-none">
                                            <div class="card h-100">
                                                @if($berita->image_url)
                                                <img src="{{ asset('storage/' . $berita->image_url) }}"
                                                    alt="{{ $berita->title }}" class="card-img-top"
                                                    style="object-fit: cover; height: 200px;">
                                                @endif
                                                <div class="card-body">
                                                    <h4 class="card-title">{{ $berita->title }}</h4>
                                                    <p class="card-text text-muted" style="font-size: 14px">
                                                        {{ $berita->created_at->translatedFormat('d F Y') }},
                                                        {{ $berita->author }}
                                                    </p>
                                                    <p class="card-text">
                                                        {{ Str::limit($berita->content, 100) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Carousel controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#newsCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#newsCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>





        <section class="village-map">
            <h2>Peta Pekon</h2>
            <div class="map-container">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13073.676787293087!2d104.5036937315328!3d-5.454878412393307!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e471b773a35af13%3A0xcd2acc87752b95a2!2sKunyayan%2C%20Wonosobo%2C%20Tanggamus%20Regency%2C%20Lampung!5e1!3m2!1sen!2sid!4v1736224063694!5m2!1sen!2sid"
                    width="100%" height="400px" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section>

        <section class="population">
            <h2>Statistik Pekon</h2>
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-number">
                        <p>{{ $statistic->total_population ?? 0 }}</p>
                    </div>
                    <div class="stat-label">Penduduk</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">
                        <p>{{ $statistic->total_families ?? 0 }}</p>
                    </div>
                    <div class="stat-label">Kepala Keluarga</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">
                        <p>3</p>
                    </div>
                    <div class="stat-label">Dusun</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">
                        <p>8</p>
                    </div>
                    <div class="stat-label">RT</div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <img src="{{ Vite::asset('resources/images/icon-tanggamus.png') }} " alt="Logo Kabupaten Tanggamus"
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
                <p><img src="{{ Vite::asset('resources/images/icon-phonecall.png') }}" alt="Phone"> 085378033300
                </p>
                <p><img src="{{ Vite::asset('resources/images/icon-mail.png') }}" alt="Email">
                    kunayannnkunayan@gmail.com</p>
                <p><img src="{{ Vite::asset('resources/images/icon-clock.png') }}" alt="Clock"> Senin - Jum'at
                    (08.00 - 15.00)</p>
                <p><img src="{{ Vite::asset('resources/images/icon-pin.png') }}" alt="Location"> Jl. Lintas Barat
                    Pekon
                    Kunyayan Kecamatan Wonosobo</p>
            </div>
        </div>
    </footer>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>
