<nav id="navbar" class="navbar">
    <ul>
        <li>
            <a href="/">
                <span class="icon bi-house"></span>
            </a>
        </li>
        @foreach ($menu as $m)
            @if (count($m->menuToSubMenu) > 0)
                <li class="dropdown">
                    <a href="{{ session('locale') !== null && session('locale') == 'id' ? $m->url_id : $m->url_en }}">
                        <span>
                            {{ session('locale') !== null && session('locale') == 'id' ? $m->menu_id : $m->menu_en }}
                        </span>
                        <i class="bi bi-chevron-down dropdown-indicator"></i>
                    </a>
                    <ul>
                        @foreach ($m->menuToSubMenu as $mts)
                            <li>
                                <a
                                    href="{{ session('locale') !== null && session('locale') == 'id' ? $mts->url_id : $mts->url_en }}">
                                    {{ session('locale') !== null && session('locale') == 'id' ? $mts->menu_id : $mts->menu_en }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @else
                <li>
                    <a href="{{ session('locale') !== null && session('locale') == 'id' ? $m->url_id : $m->url_en }}">
                        {{ session('locale') !== null && session('locale') == 'id' ? $m->menu_id : $m->menu_en }}
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</nav>
