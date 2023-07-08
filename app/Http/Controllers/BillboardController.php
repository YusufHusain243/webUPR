<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBillboardRequest;
use App\Http\Requests\UpdateBillboardRequest;
use App\Services\Services;

class BillboardController extends Controller
{
    protected $billboardServices;

    public function __construct(Services $billboardServices)
    {
        $this->billboardServices = $billboardServices;
    }

    public function index()
    {
        return view('admin/pages/billboard/billboard', [
            "data" => $this->billboardServices->index()
        ]);
    }

    public function create()
    {
        return view('admin/pages/billboard/add_billboard');
    }

    public function store(StoreBillboardRequest $request)
    {
        $validated = $request->validated();
        if ($validated) {
            $result = $this->billboardServices->store($request->all());
            if ($result) {
                return redirect('/billboard')->with('BillboardSuccess', 'Tambah Billboard Berhasil');
            }
            return redirect('/billboard')->with('BillboardError', 'Tambah Billboard Gagal');
        }
    }

    public function edit($id)
    {
        return view('admin/pages/billboard/edit_billboard', [
            'data' => $this->billboardServices->edit($id)
        ]);
    }

    public function update(UpdateBillboardRequest $request, $id)
    {
        $validated = $request->validated();

        if ($validated) {
            if ($this->billboardServices->update($request->all(), $id)) {
                return redirect('/billboard')->with('BillboardSuccess', 'Edit Billboard Berhasil');
            }
            return redirect('/billboard')->with('BillboardError', 'Edit Billboard Gagal');
        }
    }

    public function destroy($id)
    {
        if ($this->billboardServices->destroy($id)) {
            return redirect('/billboard')->with('BillboardSuccess', 'Hapus Data Berhasil');
        }
        return redirect('/billboard')->with('BillboardError', 'Hapus Data Gagal');
    }
}
