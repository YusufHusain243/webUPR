@extends('main')

@section('content')
    <main id="main">
        <section id="hero-slider" class="hero-slider">
            <div>
                <div class="row">
                    <div class="col-12">
                        <div class="swiper sliderFeaturedPosts">
                            <div class="swiper-wrapper">
                                @forelse ($billboard as $item)
                                    <div class="swiper-slide">
                                        <a href="/billboard/{{ session('locale') !== null && session('locale') == 'id' ? $item->slug_id : $item->slug_en }}"
                                            class="img-bg d-flex align-items-end"
                                            style="background-image: url({{ url('') . '/images/' . $item->foto }});">
                                            <div class="img-bg-inner">
                                                <h2>{{ session('locale') !== null && session('locale') == 'id' ? $item->judul_id : $item->judul_en }}
                                                </h2>
                                            </div>
                                        </a>
                                    </div>
                                @empty
                                @endforelse
                            </div>
                            <div class="custom-swiper-button-next">
                                <span class="bi-chevron-right"></span>
                            </div>
                            <div class="custom-swiper-button-prev">
                                <span class="bi-chevron-left"></span>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="title">
                <div class="d-flex justify-content-center">
                    <h1>
                        <strong>{{ session('locale') !== null && session('locale') == 'id' ? 'Menu Kami' : 'Our Menu' }}</strong>
                        <div class="divider"></div>
                    </h1>
                </div>
            </div>
            <br>
            <div class="container">
                <div class="row">
                    @foreach ($menu as $m)
                        @if ($m->jenis_menu == 2 || $m->jenis_menu == 3)
                            <div class="col-md-3 mb-4">
                                <a
                                    href="{{ session('locale') !== null && session('locale') == 'id' ? $m->url_id : $m->url_en }}">
                                    <div class="card shadow-sm rounded-0">
                                        <div class="card-body text-center">
                                            <img src="{{ url('') . '/images/' . $m->logo }}"
                                                class="text-center img-fluid mb-3" style="height: 100px; object-fit:cover;">
                                            <h4 class="text-center">
                                                <strong>{{ session('locale') !== null && session('locale') == 'id' ? strtoupper($m->menu_id) : strtoupper($m->menu_en) }}</strong>
                                            </h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif

                        @if (count($m->menuToSubMenu) > 0)
                            @foreach ($m->menuToSubMenu as $mts)
                                @if ($mts->jenis_menu == 2 || $mts->jenis_menu == 3)
                                    <div class="col-md-3 mb-4">
                                        <a
                                            href="{{ session('locale') !== null && session('locale') == 'id' ? $mts->url_id : $mts->url_en }}">
                                            <div class="card shadow-sm rounded-0">
                                                <div class="card-body text-center">
                                                    <img src="{{ url('') . '/images/' . $mts->logo }}"
                                                        class="text-center img-fluid mb-3"
                                                        style="height: 100px; object-fit:cover;">
                                                    <h4 class="text-center">
                                                        <strong>{{ session('locale') !== null && session('locale') == 'id' ? strtoupper($mts->menu_id) : strtoupper($mts->menu_en) }}</strong>
                                                    </h4>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </div>
            </div>
        </section>

        <section class="category-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-header d-flex justify-content-between align-items-center mb-5">
                            <h1>{{ session('locale') !== null && session('locale') == 'id' ? 'Berita & Acara' : 'News' }}
                            </h1>
                            <div><a href="/rilis"
                                    class="more">{{ session('locale') !== null && session('locale') == 'id' ? 'Lihat Semua Berita & Acara' : 'View All News & Events' }}
                                </a></div>
                        </div>
                        <div class="row">
                            @foreach ($rilis as $r)
                                <div class="col-md-4">
                                    <div class="card shadow-sm rounded-0">
                                        <div class="card-body">
                                            <picture>
                                                <img src="{{ url('') . '/images/' . $r->foto }}" class="img-fluid"
                                                    style="height:250px; width:100%; object-fit: cover;">
                                            </picture>
                                            <h5 style="margin-top:10px">
                                                <a href="/rilis/{{ session('locale') !== null && session('locale') == 'id' ? $r->slug_id : $r->slug_en }}"
                                                    class="text-dark">{{ session('locale') !== null && session('locale') == 'id' ? $r->judul_id : $r->judul_en }}</a>
                                            </h5>
                                            <div class="post-meta">
                                                <span
                                                    class="date">{{ session('locale') !== null && session('locale') == 'id' ? 'Rilis' : 'Release' }}</span>
                                                <span class="mx-1">&bullet;</span>
                                                <span>{{ $r->created_at }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-12 mt-5">
                        <div class="section-header d-flex justify-content-between align-items-center mb-5">
                            <h1>{{ session('locale') !== null && session('locale') == 'id' ? 'Pengumuman' : 'Announcement' }}
                            </h1>
                            <div><a href="/pengumuman"
                                    class="more">{{ session('locale') !== null && session('locale') == 'id' ? 'Lihat Semua Pengumuman' : 'View All Announcements' }}</a>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($pengumuman as $p)
                                <div class="col-md-4">
                                    <div class="card shadow-sm rounded-0">
                                        <div class="card-body">
                                            <picture>
                                                <img src="{{ url('') . '/images/' . $p->foto }}" class="img-fluid"
                                                    style="height:250px; width:100%; object-fit: cover;">
                                            </picture>
                                            <h5 style="margin-top:10px">
                                                <a href="/pengumuman/{{ session('locale') !== null && session('locale') == 'id' ? $p->slug_id : $p->slug_en }}"
                                                    class="text-dark">{{ session('locale') !== null && session('locale') == 'id' ? $p->judul_id : $p->judul_en }}</a>
                                            </h5>
                                            <div class="post-meta">
                                                <span
                                                    class="date">{{ session('locale') !== null && session('locale') == 'id' ? 'Rilis' : 'Release' }}</span>
                                                <span class="mx-1">&bullet;</span>
                                                <span>{{ $p->created_at }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
