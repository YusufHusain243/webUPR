<?php

namespace App\Http\Controllers;

use App\Models\Billboard;
use App\Models\Content;
use Illuminate\Support\Facades\Session;
use App\Models\Menu;
use App\Models\Setting;
use App\Models\SubMenu;

class PengunjungController extends Controller
{
    public function index()
    {
        if (session('locale') == null) {
            Session::put('locale', 'id');
        }

        if ($locale = session('locale')) {
            app()->setLocale($locale);
        }

        $setting = Setting::all();
        $rilis = Content::where('jenis', 'Rilis')->orderBy('id', 'DESC')->get();
        $pengumuman = Content::where('jenis', 'Pengumuman')->orderBy('id', 'DESC')->get();
        $billboard = Billboard::orderBy('id', 'DESC')->get();
        $menu = Menu::all();
        return view('pages/index', [
            "setting" => $setting,
            "rilis" => $rilis,
            "pengumuman" => $pengumuman,
            "billboard" => $billboard,
            "menu" => $menu,
        ]);
    }

    public function detailBillboard($slug)
    {
        $setting = Setting::all();
        if (session('locale') !== null && session('locale') == 'id') {
            $data = Billboard::where('slug_id', $slug)->get();
        } else {
            $data = Billboard::where('slug_en', $slug)->get();
        }
        $news_billboard = Billboard::take(5)->get();
        $menu = Menu::all();
        return view('pages/konten', [
            'data' => $data[0],
            "setting" => $setting,
            'news_bill' => $news_billboard,
            'menu' => $menu,
            'breadcrumb' => 'Billboard'
        ]);
    }

    public function detailRilis($slug)
    {
        $setting = Setting::all();
        if (session('locale') !== null && session('locale') == 'id') {
            $data = Content::where('slug_id', $slug)->get();
        } else {
            $data = Content::where('slug_en', $slug)->get();
        }
        $menu = Menu::all();
        return view('pages/konten', [
            'data' => $data[0],
            "setting" => $setting,
            'menu' => $menu,
            'breadcrumb' => 'Berita & Acara'
        ]);
    }

    public function detailPengumuman($slug)
    {
        $setting = Setting::all();
        if (session('locale') !== null && session('locale') == 'id') {
            $data = Content::where('slug_id', $slug)->get();
        } else {
            $data = Content::where('slug_en', $slug)->get();
        }
        $menu = Menu::all();
        return view('pages/konten', [
            'data' => $data[0],
            "setting" => $setting,
            'menu' => $menu,
            'breadcrumb' => 'Pengumuman'
        ]);
    }

    public function rilis()
    {
        $setting = Setting::all();
        $data = Content::where('jenis', '=', 'Rilis')->get();
        $menu = Menu::all();
        return view('pages/list_konten', [
            'data' => $data,
            "setting" => $setting,
            'menu' => $menu,
            'breadcrumb' => 'Berita & Acara'
        ]);
    }

    public function pengumuman()
    {
        $setting = Setting::all();
        $data = Content::where('jenis', '=', 'Pengumuman')->get();
        $menu = Menu::all();
        return view('pages/list_konten', [
            'data' => $data,
            "setting" => $setting,
            'menu' => $menu,
            'breadcrumb' => 'Pengumuman'
        ]);
    }

    public function detailMenu($slug)
    {
        $setting = Setting::all();
        if (session('locale') !== null && session('locale') == 'id') {
            $data = Menu::where('slug_id', $slug)->get();
        } else {
            $data = Menu::where('slug_en', $slug)->get();
        }
        $menu = Menu::all();
        return view('pages/konten', [
            'data' => $data[0],
            "setting" => $setting,
            'menu' => $menu,
            'breadcrumb' => 'Menu'
        ]);
    }

    public function detailSubMenu($slug)
    {
        $setting = Setting::all();
        if (session('locale') !== null && session('locale') == 'id') {
            $data = SubMenu::where('slug_id', $slug)->get();
        } else {
            $data = SubMenu::where('slug_en', $slug)->get();
        }
        $side_menu = SubMenu::where('id_menu', $data[0]->id_menu)->get();
        $menu = Menu::all();
        return view('pages/konten', [
            'data' => $data[0],
            "setting" => $setting,
            'side_menu' => $side_menu,
            'menu' => $menu,
            'breadcrumb' => 'Sub Menu'
        ]);
    }

    public function switch($locale)
    {
        Session::put('locale', $locale);
        return redirect('/');
    }
}
