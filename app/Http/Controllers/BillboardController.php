<?php

namespace App\Http\Controllers;

use App\Models\Billboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BillboardController extends Controller
{
    public function index()
    {
        $data = Billboard::all();
        return view('admin/pages/billboard/billboard', [
            "data" => $data
        ]);
    }

    public function create()
    {
        return view('admin/pages/billboard/add_billboard');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'judul_id' => 'required|unique',
                'judul_en' => 'required|unique',
                'content_id' => 'required',
                'content_en' => 'required',
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            ],
            [
                'judul_id.required' => 'Judul (ID) tidak boleh kosong',
                'judul_en.required' => 'Judul (EN) tidak boleh kosong',
                'judul_id.unique' => 'Judul (ID) sudah ada',
                'judul_en.unique' => 'Judul (EN) sudah ada',
                'content_id.required' => 'Content (ID) tidak boleh kosong',
                'content_en.required' => 'Content (EN) tidak boleh kosong',
            ]
        );


        if ($validator) {
            if (isset($request->foto)) {
                $file_gambar = $request->foto->getClientOriginalName();
                $file_name_asli = Str::slug(pathinfo($file_gambar, PATHINFO_FILENAME));
                $name = uniqid() . $file_name_asli . '.' . $request->foto->getClientOriginalExtension();
                $result = $request->foto->move(public_path('storage/images'), $name);
            }

            $result = Billboard::create([
                'judul_id' => $request->judul_id,
                'judul_en' => $request->judul_en,
                'slug_id' => Str::slug($request->judul_id),
                'slug_en' => Str::slug($request->judul_en),
                'content_id' => $request->content_id,
                'content_en' => $request->content_en,
                'foto' => $name,
            ]);

            if ($result) {
                return redirect('/billboard')->with('BillboardSuccess', 'Tambah Billboard Berhasil');
            }
            unlink(public_path('storage/images/' . $name));
            return redirect('/billboard')->with('BillboardError', 'Tambah Billboard Gagal');
        }
    }

    public function edit($id)
    {
        $data = Billboard::findOrFail($id);
        return view('admin/pages/billboard/edit_billboard', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'judul_id' => 'required|unique',
                'judul_en' => 'required|unique',
                'content_id' => 'required',
                'content_en' => 'required',
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            ],
            [
                'judul_id.required' => 'Judul (ID) tidak boleh kosong',
                'judul_en.required' => 'Judul (EN) tidak boleh kosong',
                'judul_id.unique' => 'Judul (ID) sudah ada',
                'judul_en.unique' => 'Judul (EN) sudah ada',
                'content_id.required' => 'Content (ID) tidak boleh kosong',
                'content_en.required' => 'Content (EN) tidak boleh kosong',
            ]
        );

        if ($validator) {
            $data = Billboard::findOrFail($id);
            if (isset($request->foto)) {
                
                if (file_exists(public_path('storage/images/' . $data->foto))) {
                    unlink(public_path('storage/images/' . $data->foto));
                }

                $file_gambar = $request->foto->getClientOriginalName();
                $file_name_asli = Str::slug(pathinfo($file_gambar, PATHINFO_FILENAME));
                $name = uniqid() . $file_name_asli . '.' . $request->foto->getClientOriginalExtension();
                $request->foto->move(public_path('storage/images'), $name);

                $result = $data->update([
                    'judul_id' => $request->judul_id,
                    'judul_en' => $request->judul_en,
                    'slug_id' => Str::slug($request->judul_id),
                    'slug_en' => Str::slug($request->judul_en),
                    'content_id' => $request->content_id,
                    'content_en' => $request->content_en,
                    'foto' => $name,
                ]);

                if ($result) {
                    return redirect('/billboard')->with('BillboardSuccess', 'Edit Billboard Berhasil');
                }
                return redirect('/billboard')->with('BillboardError', 'Edit Billboard Gagal');
            } else {
                $result = $data->update([
                    'judul_id' => $request->judul_id,
                    'judul_en' => $request->judul_en,
                    'slug_id' => Str::slug($request->judul_id),
                    'slug_en' => Str::slug($request->judul_en),
                    'content_id' => $request->content_id,
                    'content_en' => $request->content_en,
                ]);

                if ($result) {
                    return redirect('/billboard')->with('BillboardSuccess', 'Edit Billboard Berhasil');
                }
                return redirect('/billboard')->with('BillboardError', 'Edit Billboard Gagal');
            }
        }
    }

    public function destroy($id)
    {
        $data = Billboard::findOrFail($id);
        if ($data) {
            $result = $data->delete();
            unlink(public_path('storage/images/' . $data->foto));
            if ($result) {
                return redirect('/billboard')->with('BillboardSuccess', 'Hapus Data Berhasil');
            }
            return redirect('/billboard')->with('BillboardError', 'Hapus Data Gagal');
        }
    }
}
