<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function index()
    {
        $data = Setting::all();
        return view('admin/pages/setting', [
            "data" => $data
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name_id' => 'required',
                'name_en' => 'required',
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
                'color' => 'required',
                'email' => 'required',
                'wa' => 'required',
            ],
            [
                'name_id.required' => 'Nama Aplikasi (ID) tidak boleh kosong',
                'name_en.required' => 'Nama Aplikasi (EN) tidak boleh kosong',
                'color.required' => 'Color tidak boleh kosong',
                'email.required' => 'email tidak boleh kosong',
                'wa.required' => 'wa tidak boleh kosong',
            ]
        );


        if ($validator) {
            $cek = Setting::all();

            if (count($cek) > 0) {
                $result = $this->update($cek[0], $request);
                if ($result) {
                    return redirect('/setting')->with('SettingSuccess', 'Edit Setting Berhasil');
                }
                return redirect('/setting')->with('SettingError', 'Edit Setting Gagal');
            } else {
                if (isset($request->logo)) {
                    $file_gambar = $request->logo->getClientOriginalName();
                    $file_name_asli = Str::slug(pathinfo($file_gambar, PATHINFO_FILENAME));
                    $name = uniqid() . $file_name_asli . '.' . $request->logo->getClientOriginalExtension();
                    $result = $request->logo->move($_SERVER['DOCUMENT_ROOT'] . '/images', $name);
                }

                $result = Setting::create([
                    'name_id' => $request->name_id,
                    'name_en' => $request->name_en,
                    'logo' => $name,
                    'color' => $request->color,
                    'email' => $request->email,
                    'wa' => $request->wa,
                ]);

                if ($result) {
                    return redirect('/setting')->with('SettingSuccess', 'Tambah Setting Berhasil');
                }
                if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/images/' . $name)) {
                    unlink($_SERVER['DOCUMENT_ROOT'] . '/images/' . $name);
                }
                return redirect('/setting')->with('SettingError', 'Tambah Setting Gagal');
            }
        }
    }

    public function update($data, $request)
    {
        if (isset($request->logo)) {

            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/images/' . $data->logo) && isset($data->logo)) {
                unlink($_SERVER['DOCUMENT_ROOT'] . '/images/' . $data->logo);
            }

            $file_gambar = $request->logo->getClientOriginalName();
            $file_name_asli = Str::slug(pathinfo($file_gambar, PATHINFO_FILENAME));
            $name = uniqid() . $file_name_asli . '.' . $request->logo->getClientOriginalExtension();
            $request->logo->move($_SERVER['DOCUMENT_ROOT'] . '/images', $name);

            $result = $data->update([
                'name_id' => $request->name_id,
                'name_en' => $request->name_en,
                'logo' => $name,
                'color' => $request->color,
                'email' => $request->email,
                'wa' => $request->wa,
            ]);

            if ($result) {
                return true;
            }
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/images/' . $name)) {
                unlink($_SERVER['DOCUMENT_ROOT'] . '/images/' . $name);
            }
            return false;
        } else {
            $result = $data->update([
                'name_id' => $request->name_id,
                'name_en' => $request->name_en,
                'color' => $request->color,
                'email' => $request->email,
                'wa' => $request->wa,
            ]);

            if ($result) {
                return true;
            }
            return false;
        }
    }
}
