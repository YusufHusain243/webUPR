<?php

namespace App\Http\Controllers;

use App\Models\ContentMenu;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function index()
    {
        $data = Menu::all();
        return view('admin/pages/menu/menu', [
            "data" => $data
        ]);
    }

    public function create()
    {
        return view('admin/pages/menu/add_menu');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'menu_id' => 'required|unique',
                'menu_en' => 'required|unique',
                'status' => 'required',
                'url_id' => 'required',
                'url_en' => 'required',
                'jenis_menu' => 'required',
                'logo' => 'required_if:jenis_menu,==,2|required_if:jenis_menu,==,3|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
                'page' => 'required',
            ],
            [
                'menu_id.required' => 'Menu (ID) tidak boleh kosong',
                'menu_en.required' => 'Menu (En) tidak boleh kosong',
                'menu_id.unique' => 'Menu (ID) sudah ada',
                'menu_en.unique' => 'Menu (En) sudah ada',
                'status.required' => 'Status tidak boleh kosong',
                'url_id.required' => 'URL (ID) tidak boleh kosong',
                'url_en.required' => 'URL (EN) tidak boleh kosong',
                'jenis_menu.required' => 'Jenis Menu tidak boleh kosong',
                'logo.required' => 'Logo tidak boleh kosong',
                'page.required' => 'Page tidak boleh kosong',
            ]
        );

        if ($validator) {
            $result = null;
            if (isset($request->logo)) {
                $file_gambar = $request->logo->getClientOriginalName();
                $file_name_asli = Str::slug(pathinfo($file_gambar, PATHINFO_FILENAME));
                $name = uniqid() . $file_name_asli . '.' . $request->logo->getClientOriginalExtension();
                $result = $request->logo->move($_SERVER['DOCUMENT_ROOT'] . '/images', $name);
                $result = Menu::create([
                    'menu_id' => $request->menu_id,
                    'menu_en' => $request->menu_en,
                    'slug_id' => Str::slug($request->menu_id),
                    'slug_en' => Str::slug($request->menu_en),
                    'status' => $request->status,
                    'url_id' => $request->url_id,
                    'url_en' => $request->url_en,
                    'jenis_menu' => $request->jenis_menu,
                    'logo' => $name,
                    'page' => $request->page,
                ]);
            } else {
                $result = Menu::create([
                    'menu_id' => $request->menu_id,
                    'menu_en' => $request->menu_en,
                    'slug_id' => Str::slug($request->menu_id),
                    'slug_en' => Str::slug($request->menu_en),
                    'status' => $request->status,
                    'url_id' => $request->url_id,
                    'url_en' => $request->url_en,
                    'jenis_menu' => $request->jenis_menu,
                    'page' => $request->page,
                ]);
            }

            if ($result) {
                if ($request->page == 'Ya') {
                    $menu_id = $result->id;
                    $result2 = ContentMenu::create([
                        'id_menu' => $menu_id,
                        'page_id' => $request->page_id,
                        'page_en' => $request->page_en,
                    ]);

                    if ($result2) {
                        return redirect('/menu')->with('MenuSuccess', 'Tambah Menu Berhasil');
                    }
                    return redirect('/menu')->with('MenuError', 'Tambah Menu Gagal');
                }
                return redirect('/menu')->with('MenuSuccess', 'Tambah Menu Berhasil');
            }
            return redirect('/menu')->with('MenuError', 'Tambah Menu Gagal');
        }
    }

    public function edit($id)
    {
        $data = Menu::findOrFail($id);
        return view('admin/pages/menu/edit_menu', [
            "data" => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'menu_id' => 'required|unique',
                'menu_en' => 'required|unique',
                'status' => 'required',
                'url_id' => 'required',
                'url_en' => 'required',
                'jenis_menu' => 'required',
                'logo' => 'required_if:jenis_menu,==,2|required_if:jenis_menu,==,3|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
                'page' => 'required',
            ],
            [
                'menu_id.required' => 'Menu (ID) tidak boleh kosong',
                'menu_en.required' => 'Menu (En) tidak boleh kosong',
                'menu_id.unique' => 'Menu (ID) sudah ada',
                'menu_en.unique' => 'Menu (En) sudah ada',
                'status.required' => 'Status tidak boleh kosong',
                'url_id.required' => 'URL (ID) tidak boleh kosong',
                'url_en.required' => 'URL (EN) tidak boleh kosong',
                'jenis_menu.required' => 'Jenis Menu tidak boleh kosong',
                'logo.required' => 'Logo tidak boleh kosong',
                'page.required' => 'Page tidak boleh kosong',
            ]
        );

        if ($validator) {
            $result = null;
            $data = Menu::findOrFail($id);

            if ($request->jenis_menu == 2 || $request->jenis_menu == 3) {
                if (isset($request->logo)) {
                    if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/images/' . $data->logo) && isset($data->logo)) {
                        unlink($_SERVER['DOCUMENT_ROOT'] . '/images/' . $data->logo);
                    }
                    $file_gambar = $request->logo->getClientOriginalName();
                    $file_name_asli = Str::slug(pathinfo($file_gambar, PATHINFO_FILENAME));
                    $name = uniqid() . $file_name_asli . '.' . $request->logo->getClientOriginalExtension();
                    $result = $request->logo->move($_SERVER['DOCUMENT_ROOT'] . '/images', $name);
                    $result = $data->update([
                        'menu_id' => $request->menu_id,
                        'menu_en' => $request->menu_en,
                        'slug_id' => Str::slug($request->menu_id),
                        'slug_en' => Str::slug($request->menu_en),
                        'status' => $request->status,
                        'url_id' => $request->url_id,
                        'url_en' => $request->url_en,
                        'jenis_menu' => $request->jenis_menu,
                        'logo' => $name,
                        'page' => $request->page,
                    ]);
                } else {
                    $result = $data->update([
                        'menu_id' => $request->menu_id,
                        'menu_en' => $request->menu_en,
                        'slug_id' => Str::slug($request->menu_id),
                        'slug_en' => Str::slug($request->menu_en),
                        'status' => $request->status,
                        'url_id' => $request->url_id,
                        'url_en' => $request->url_en,
                        'jenis_menu' => $request->jenis_menu,
                        'page' => $request->page,
                    ]);
                }
            } else {
                $result = $data->update([
                    'menu_id' => $request->menu_id,
                    'menu_en' => $request->menu_en,
                    'slug_id' => Str::slug($request->menu_id),
                    'slug_en' => Str::slug($request->menu_en),
                    'status' => $request->status,
                    'url_id' => $request->url_id,
                    'url_en' => $request->url_en,
                    'jenis_menu' => $request->jenis_menu,
                    'logo' => null,
                    'page' => $request->page,
                ]);
            }

            if ($result) {
                if ($request->page == 'Ya') {
                    if (isset($data)) {
                        $result = ContentMenu::where('id_menu', $id)->update([
                            'page_id' => $request->page_id,
                            'page_en' => $request->page_en,
                        ]);
                    } else {
                        $result = ContentMenu::create([
                            'id_menu' => $id,
                            'page_id' => $request->page_id,
                            'page_en' => $request->page_en,
                        ]);
                    }
                } else {
                    $result = ContentMenu::where('id_menu', $id)->delete();
                }
            }

            if ($result) {
                return redirect('/menu')->with('MenuSuccess', 'Edit Menu Berhasil');
            }
            return redirect('/menu')->with('MenuError', 'Edit Menu Gagal');
        }
    }

    public function destroy($id)
    {
        $data = Menu::findOrFail($id);
        if ($data) {
            $result = $data->delete();
            if (isset($data->logo)) {
                unlink($_SERVER['DOCUMENT_ROOT'] . '/images/' . $data->logo);
            }
            if ($result) {
                return redirect('/menu')->with('MenuSuccess', 'Hapus Data Berhasil');
            }
            return redirect('/menu')->with('MenuError', 'Hapus Data Gagal');
        }
    }
}
