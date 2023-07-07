<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    public function index()
    {
        $data = Content::all();
        return view('admin/pages/konten/konten', [
            "data" => $data
        ]);
    }

    public function create()
    {
        return view('admin/pages/konten/add_konten');
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
                'jenis' => 'required',
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            ],
            [
                'judul_id.required' => 'Judul (ID) tidak boleh kosong',
                'judul_en.required' => 'Judul (EN) tidak boleh kosong',
                'judul_id.unique' => 'Judul (ID) sudah ada',
                'judul_en.unique' => 'Judul (EN) sudah ada',
                'content_id.required' => 'Content (ID) tidak boleh kosong',
                'content_en.required' => 'Content (EN) tidak boleh kosong',
                'jenis.required' => 'Jenis tidak boleh kosong',
            ]
        );


        if ($validator) {
            if (isset($request->foto)) {
                $file_gambar = $request->foto->getClientOriginalName();
                $file_name_asli = Str::slug(pathinfo($file_gambar, PATHINFO_FILENAME));
                $name = uniqid() . $file_name_asli . '.' . $request->foto->getClientOriginalExtension();
                $result = $request->foto->move($_SERVER['DOCUMENT_ROOT'] . '/images', $name);
            }

            $result = Content::create([
                'judul_id' => $request->judul_id,
                'judul_en' => $request->judul_en,
                'slug_id' => Str::slug($request->judul_id),
                'slug_en' => Str::slug($request->judul_en),
                'content_id' => $request->content_id,
                'content_en' => $request->content_en,
                'jenis' => $request->jenis,
                'foto' => $name,
            ]);

            if ($result) {
                return redirect('/konten')->with('KontenSuccess', 'Tambah Konten Berhasil');
            }
            return redirect('/konten')->with('KontenError', 'Tambah Konten Gagal');
        }
    }

    public function edit($id)
    {
        $data = Content::findOrFail($id);
        return view('admin/pages/konten/edit_konten', ['data' => $data]);
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
                'jenis' => 'required',
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            ],
            [
                'judul_id.required' => 'Judul (ID) tidak boleh kosong',
                'judul_en.required' => 'Judul (EN) tidak boleh kosong',
                'judul_id.unique' => 'Judul (ID) sudah ada',
                'judul_en.unique' => 'Judul (EN) sudah ada',
                'content_id.required' => 'Content (ID) tidak boleh kosong',
                'content_en.required' => 'Content (EN) tidak boleh kosong',
                'jenis.required' => 'Jenis tidak boleh kosong',
            ]
        );

        if ($validator) {
            $data = Content::findOrFail($id);
            if (isset($request->foto)) {

                if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/images/' . $data->foto) && isset($data->foto)) {
                    unlink($_SERVER['DOCUMENT_ROOT'] . '/images/' . $data->foto);
                }

                $file_gambar = $request->foto->getClientOriginalName();
                $file_name_asli = Str::slug(pathinfo($file_gambar, PATHINFO_FILENAME));
                $name = uniqid() . $file_name_asli . '.' . $request->foto->getClientOriginalExtension();
                $request->foto->move($_SERVER['DOCUMENT_ROOT'] . '/images', $name);

                $result = $data->update([
                    'judul_id' => $request->judul_id,
                    'judul_en' => $request->judul_en,
                    'slug_id' => Str::slug($request->judul_id),
                    'slug_en' => Str::slug($request->judul_en),
                    'content_id' => $request->content_id,
                    'content_en' => $request->content_en,
                    'jenis' => $request->jenis,
                    'foto' => $name,
                ]);

                if ($result) {
                    return redirect('/konten')->with('KontenSuccess', 'Edit Konten Berhasil');
                }
                return redirect('/konten')->with('KontenError', 'Edit Konten Gagal');
            } else {
                $result = $data->update([
                    'judul_id' => $request->judul_id,
                    'judul_en' => $request->judul_en,
                    'slug_id' => Str::slug($request->judul_id),
                    'slug_en' => Str::slug($request->judul_en),
                    'content_id' => $request->content_id,
                    'content_en' => $request->content_en,
                    'jenis' => $request->jenis,
                ]);

                if ($result) {
                    return redirect('/konten')->with('KontenSuccess', 'Edit Konten Berhasil');
                }
                return redirect('/konten')->with('KontenError', 'Edit Konten Gagal');
            }
        }
    }

    public function destroy($id)
    {
        $data = Content::findOrFail($id);
        if ($data) {
            $result = $data->delete();
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/images/' . $data->foto) && isset($data->foto)) {
                unlink($_SERVER['DOCUMENT_ROOT'] . '/images/' . $data->foto);
            }
            if ($result) {
                return redirect('/konten')->with('KontenSuccess', 'Hapus Data Berhasil');
            }
            return redirect('/konten')->with('KontenError', 'Hapus Data Gagal');
        }
    }
}
