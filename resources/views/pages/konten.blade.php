@extends('main')

@section('content')
    <main id="main">
        <section class="single-post-content">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" style="color: black;">Home</a></li>
                        <li class="breadcrumb-item"><a href="#" style="color: black;">{{ $breadcrumb }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            @if ($breadcrumb == 'Sub Menu')
                                {{ session('locale') !== null && session('locale') == 'id' ? $data->menu_id : $data->menu_en }}
                            @else
                                {{ session('locale') !== null && session('locale') == 'id' ? $data->judul_id : $data->judul_en }}
                            @endif
                        </li>
                    </ol>
                </nav>
                <br>
                <div class="row">
                    <div class="col-9">
                        <div class="card shadow border-0">
                            <div class="card-body">

                                @if ($breadcrumb == 'Sub Menu')
                                    <h1>
                                        {{ session('locale') !== null && session('locale') == 'id' ? $data->menu_id : $data->menu_en }}
                                    </h1>
                                @else
                                    <h1>
                                        {{ session('locale') !== null && session('locale') == 'id' ? $data->judul_id : $data->judul_en }}
                                    </h1>
                                @endif

                                @if ($breadcrumb == 'Billboard' || $breadcrumb == 'Berita & Acara' || $breadcrumb == 'Pengumuman')
                                    <img src="{{ asset('storage/images/' . $data->foto) }}" class="img-fluid"
                                        style="width: 100vw;">
                                    <hr>
                                    @if (session('locale') !== null && session('locale') == 'id')
                                        {!! $data->content_id !!}
                                    @else
                                        {!! $data->content_en !!}
                                    @endif
                                @else
                                    @if ($breadcrumb == 'Menu')
                                        @if (session('locale') !== null && session('locale') == 'id')
                                            {!! $data->menuToContent->page_id !!}
                                        @else
                                            {!! $data->menuToContent->page_en !!}
                                        @endif
                                    @else
                                        @if (session('locale') !== null && session('locale') == 'id')
                                            {!! $data->subMenuToContent->page_id !!}
                                        @else
                                            {!! $data->subMenuToContent->page_en !!}
                                        @endif
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    @if ($breadcrumb == 'Billboard')
                        <div class="col-md-3" style="padding: 0 40px 0;">
                            <div class=" aside-block">
                                <h3 class="aside-title">Billboard</h3>
                                <ul class="aside-links list-unstyled">
                                    @foreach ($news_bill as $item)
                                        <li>
                                            <a
                                                href="/billboard/{{ session('locale') !== null && session('locale') == 'id' ? $item->slug_id : $item->slug_en }}">
                                                <i class="bi bi-chevron-right"></i>
                                                {{ session('locale') !== null && session('locale') == 'id' ? $item->judul_id : $item->judul_en }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    @if ($breadcrumb == 'Menu')
                        <div class="col-md-3" style="padding: 0 40px 0;">
                            <div class=" aside-block">
                                <h3 class="aside-title">Menu</h3>
                                <ul class="aside-links list-unstyled">
                                    @foreach ($menu as $item)
                                        {{-- <li>
                                            <a href="/menu/{{ $item->slug_id }}">
                                                <i class="bi bi-chevron-right"></i>
                                                {{ $item->menu_id }}
                                            </a>
                                        </li> --}}
                                        <li>
                                            <a
                                                href="/menu/{{ session('locale') !== null && session('locale') == 'id' ? $item->slug_id : $item->slug_en }}">
                                                <i class="bi bi-chevron-right"></i>
                                                {{ session('locale') !== null && session('locale') == 'id' ? $item->menu_id : $item->menu_en }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    @if ($breadcrumb == 'Sub Menu')
                        <div class="col-md-3" style="padding: 0 40px 0;">
                            <div class=" aside-block">
                                <h3 class="aside-title">Sub Menu</h3>
                                <ul class="aside-links list-unstyled">
                                    @foreach ($side_menu as $item)
                                        {{-- <li>
                                            <a href="/sub-menu/{{ $item->slug_id }}">
                                                <i class="bi bi-chevron-right"></i>
                                                {{ $item->menu_id }}
                                            </a>
                                        </li> --}}
                                        <li>
                                            <a
                                                href="/sub-menu/{{ session('locale') !== null && session('locale') == 'id' ? $item->slug_id : $item->slug_en }}">
                                                <i class="bi bi-chevron-right"></i>
                                                {{ session('locale') !== null && session('locale') == 'id' ? $item->menu_id : $item->menu_en }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    @if ($breadcrumb == 'Berita & Acara' || $breadcrumb == 'Pengumuman')
                        <div class="col-md-3" style="padding: 0 40px 0;">
                            <div class=" aside-block">
                                <h3 class="aside-title">Menu</h3>
                                <ul class="aside-links list-unstyled">
                                    <li>
                                        <a href="/rilis">
                                            <i class="bi bi-chevron-right"></i>
                                            {{ session('locale') !== null && session('locale') == 'id' ? 'Rilis' : 'Release' }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/pengumuman">
                                            <i class="bi bi-chevron-right"></i>
                                            {{ session('locale') !== null && session('locale') == 'id' ? 'Pengumuman' : 'Announcement' }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </main>
< @endsection
