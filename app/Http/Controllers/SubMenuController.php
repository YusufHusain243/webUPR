<?php

namespace App\Http\Controllers;

use App\Models\ContentSubMenu;
use App\Models\SubMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Menu;

class SubMenuController extends Controller
{
    public function index($id)
    {
        $menu = Menu::findOrFail($id);
        $data = SubMenu::all();
        return view('admin/pages/sub_menu/sub_menu', [
            "menu" => $menu,
            "data" => $data,
        ]);
    }

    public function create($id)
    {
        $data = Menu::findOrFail($id);
        return view('admin/pages/sub_menu/add_sub_menu', [
            "data" => $data
        ]);
    }

    public function store(Request $request, $id)
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
                $result = $request->logo->move(public_path('storage/images'), $name);
                $result = SubMenu::create([
                    'id_menu' => $id,
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
                $result = SubMenu::create([
                    'id_menu' => $id,
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
                    $result2 = ContentSubMenu::create([
                        'id_sub_menu' => $menu_id,
                        'page_id' => $request->page_id,
                        'page_en' => $request->page_en,
                    ]);

                    if ($result2) {
                        return redirect('/list-sub-menu/' . $id)->with('SubMenuSuccess', 'Tambah SubMenu Berhasil');
                    }
                    return redirect('/list-sub-menu/' . $id)->with('SubMenuError', 'Tambah SubMenu Gagal');
                }
                return redirect('/list-sub-menu/' . $id)->with('SubMenuSuccess', 'Tambah SubMenu Berhasil');
            }
            return redirect('/list-sub-menu/' . $id)->with('SubMenuError', 'Tambah SubMenu Gagal');
        }
    }

    public function edit($id, $id_menu)
    {
        $data = SubMenu::findOrFail($id);
        $menu = Menu::findOrFail($id_menu);
        return view('admin/pages/sub_menu/edit_sub_menu', [
            "data" => $data,
            "menu" => $menu,
        ]);
    }

    public function update(Request $request, $id, $id_menu)
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
            $data = SubMenu::findOrFail($id);

            if ($request->jenis_menu == 2 || $request->jenis_menu == 3) {
                // if (file_exists(public_path('storage/images/' . $data->logo))) {
                //     unlink(public_path('storage/images/' . $data->logo));
                // }
                if (isset($request->logo)) {
                    $file_gambar = $request->logo->getClientOriginalName();
                    $file_name_asli = Str::slug(pathinfo($file_gambar, PATHINFO_FILENAME));
                    $name = uniqid() . $file_name_asli . '.' . $request->logo->getClientOriginalExtension();
                    $request->logo->move(public_path('storage/images'), $name);
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
                    if (isset($data2)) {
                        $result = ContentSubMenu::where('id_sub_menu', $id)->update([
                            'page_id' => $request->page_id,
                            'page_en' => $request->page_en,
                        ]);
                    } else {
                        $result = ContentSubMenu::create([
                            'id_sub_menu' => $id,
                            'page_id' => $request->page_id,
                            'page_en' => $request->page_en,
                        ]);
                    }
                } else {
                    $result = ContentSubMenu::where('id_sub_menu', $id)->delete();
                }
            }

            if ($result) {
                return redirect('/list-sub-menu/' . $id_menu)->with('SubMenuSuccess', 'Edit Sub Menu Berhasil');
            }
            return redirect('/list-sub-menu/' . $id_menu)->with('SubMenuError', 'Edit Sub Menu Gagal');
        }
    }

    public function destroy($id, $id_menu)
    {
        $data = SubMenu::findOrFail($id);
        if ($data) {
            $result = $data->delete();
            if (isset($data->logo)) {
                unlink(public_path('storage/images/' . $data->logo));
            }
            if ($result) {
                return redirect('/list-sub-menu/' . $id_menu)->with('SubMenuSuccess', 'Hapus Data Berhasil');
            }
            return redirect('/list-sub-menu/' . $id_menu)->with('SubMenuError', 'Hapus Data Gagal');
        }
    }
}
