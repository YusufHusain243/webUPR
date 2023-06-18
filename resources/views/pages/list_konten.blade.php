@extends('main')

@section('content')
    <main id="main">
        <section>
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" style="color: black;">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb }}</li>
                    </ol>
                </nav>
                <div class="row">
                    <div class="col-md-9" style="box-shadow: 0 4px 6px rgb(0 0 0 / 10%);padding: 20px;">
                        <div>
                            @foreach ($data as $item)
                                <div class="d-md-flex post-entry-2 half">
                                    @if ($breadcrumb === 'Berita & Acara')
                                        <a href="/rilis/{{ session('locale') !== null && session('locale') == 'id' ? $item->slug_id : $item->slug_en }}"
                                            class="me-4 thumbnail">
                                            <img src="{{ asset('storage/images/' . $item->foto) }}" class="img-fluid"
                                                style="height:250px; object-fit: cover;">
                                        </a>
                                    @else
                                        <a href="/{{ strtolower($breadcrumb) }}/{{ session('locale') !== null && session('locale') == 'id' ? $item->slug_id : $item->slug_en }}""
                                            class="me-4 thumbnail">
                                            <img src="{{ asset('storage/images/' . $item->foto) }}" class="img-fluid"
                                                style="height:250px; object-fit: cover;">
                                        </a>
                                    @endif
                                    <div>
                                        <div class="post-meta">
                                            <span class="date">Rilis</span>
                                            <span class="mx-1">&bullet;</span>
                                            <span>{{ $item->created_at }}</span>
                                        </div>
                                        <h3>
                                            @if ($breadcrumb === 'Berita & Acara')
                                                <a href="/rilis/{{ session('locale') !== null && session('locale') == 'id' ? $item->slug_id : $item->slug_en }}""
                                                    style="font-size: 18px;color: black;">{{ session('locale') !== null && session('locale') == 'id' ? $item->judul_id : $item->judul_en }}"
                                                </a>
                                            @else
                                                <a href="/{{ strtolower($breadcrumb) }}/{{ session('locale') !== null && session('locale') == 'id' ? $item->slug_id : $item->slug_en }}""
                                                    style="font-size: 18px;color: black;">{{ session('locale') !== null && session('locale') == 'id' ? $item->judul_id : $item->judul_en }}"
                                                </a>
                                            @endif
                                        </h3>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
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
                </div>
            </div>
        </section>
    </main>
@endsection
