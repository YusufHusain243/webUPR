<header id="header" class="header d-flex align-items-center fixed-top"
    style="background-color:{{ isset($setting[0]->color) ? $setting[0]->color : '#043507' }}">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
        <a href="/" class="logo d-flex align-items-center">
            <img src="{{ isset($setting[0]->logo) ? asset('storage/images/' . $setting[0]->logo) : '' }}" alt="Logo UPR">
            <h1>{{ isset($setting[0]->logo) ? (session('locale') !== null && session('locale') == 'id' ? $setting[0]->name_id : $setting[0]->name_en) : '' }}
            </h1>
        </a>
        @include('components/navbar')

        <div class="position-relative">
            <div class="btn-group dropend bhs" style="top:-3px">
                <button type="button" class="btn btn-default" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ session('locale') !== null && session('locale') == 'id' ? asset('img/id.png') : asset('img/en.png') }}"
                        width="16" height="16" alt=""></a>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="/switch/en">
                            <img src="{{ asset('img/en.png') }}" alt=""> English
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="/switch/id">
                            <img src="{{ asset('img/id.png') }}" alt=""> Bahasa
                        </a>
                    </li>
                </ul>
            </div>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </div>
    </div>
</header>
