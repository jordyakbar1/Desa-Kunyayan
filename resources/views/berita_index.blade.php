<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita - Pekon Kunyayan</title>
    @vite(['resources/css/styles.css'])
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
                @auth
                    @if (auth()->user()->hasRole('admin'))
                        <li>
                            <a href="{{ route('admin.home') }}" class="{{ Request::is('admin/home') ? 'active' : '' }}">Dashboard</a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
        </nav>
    </header>

    <main class="berita-content">
        <section class="berita-header">
            <h1>Berita Desa</h1>
            <p>Menyajikan informasi terbaru tentang peristiwa, berita terkini, dan artikel-artikel jurnalistik dari Pekon Kunyayan</p>
        </section>

        <section class="berita-list">
            @forelse ($beritas as $berita)
                <article class="berita-card">
                    @if ($berita->image_url)
                        <div style="margin-bottom: 15px; border-radius: 6px; overflow: hidden;">
                            <img src="{{ asset('storage/' . $berita->image_url) }}" alt="{{ $berita->title }}" style="width: 100%; height: 250px; object-fit: cover;">
                        </div>
                    @endif
                    <h2 class="berita-title">
                        <a href="{{ route('berita.show', $berita->id) }}">{{ $berita->title }}</a>
                    </h2>
                    <p class="berita-excerpt">{{ Str::limit($berita->content, 200) }}</p>
                    <div class="berita-meta">
                        <span class="berita-author">{{ $berita->author }}</span>
                        <span class="berita-views">Dibaca {{ $berita->views }} kali</span>
                    </div>
                    <div class="berita-date">
                        {{ $berita->created_at->translatedFormat('d M Y') }}
                    </div>
                </article>
            @empty
                <div class="empty-message">
                    <p>Belum ada berita. Silahkan kembali lagi nanti.</p>
                </div>
            @endforelse
        </section>

        @if ($beritas->hasPages())
            <div style="margin-top: 30px; text-align: center;">
                {{ $beritas->links() }}
            </div>
        @endif
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <img src="{{ Vite::asset('resources/images/icon-tanggamus.png') }}" alt="Logo Kabupaten Tanggamus"
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
                    Pekon Kunyayan Kecamatan Wonosobo</p>
            </div>
        </div>
    </footer>

    @auth
        @if (auth()->user()->hasRole('admin'))
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endif
    @endauth
</body>

</html>
