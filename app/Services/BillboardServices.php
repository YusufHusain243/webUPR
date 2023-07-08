<?php

namespace App\Services;

use App\Models\Billboard;
use App\Repository\Repository;
use Illuminate\Support\Str;

class BillboardServices implements Services
{
    protected $billboardRepository;

    public function __construct(Repository $billboardRepository)
    {
        $this->billboardRepository = $billboardRepository;
    }

    public function index()
    {
        return $this->billboardRepository->index();
    }

    public function store($data)
    {
        if (isset($data['foto'])) {
            $name = $this->uploadImage($data);
        }

        if ($this->billboardRepository->store([
            'judul_id' => $data['judul_id'],
            'judul_en' => $data['judul_en'],
            'slug_id' => Str::slug($data['judul_id']),
            'slug_en' => Str::slug($data['judul_en']),
            'content_id' => $data['content_id'],
            'content_en' => $data['content_en'],
            'foto' => $name,
        ])) {
            return true;
        }
        unlink(public_path('storage/images/' . $name));
        return false;
    }

    public function edit($id)
    {
        return $this->billboardRepository->edit($id);
    }

    public function update($request, $id)
    {
        $billboardData = Billboard::findOrFail($id);
        if (isset($request['foto'])) {
            $this->deleteImage($billboardData);
            $name = $this->uploadImage($request);
            if ($this->billboardRepository->update([
                'judul_id' => $request['judul_id'],
                'judul_en' => $request['judul_en'],
                'slug_id' => Str::slug($request['judul_id']),
                'slug_en' => Str::slug($request['judul_en']),
                'content_id' => $request['content_id'],
                'content_en' => $request['content_en'],
                'foto' => $name,
            ], $id)) {
                return true;
            }
            return false;
        } else {
            if ($this->billboardRepository->update([
                'judul_id' => $request['judul_id'],
                'judul_en' => $request['judul_en'],
                'slug_id' => Str::slug($request['judul_id']),
                'slug_en' => Str::slug($request['judul_en']),
                'content_id' => $request['content_id'],
                'content_en' => $request['content_en'],
            ], $id)) {
                return true;
            }
            return false;
        }
    }

    public function destroy($id)
    {
        $data = Billboard::findOrFail($id);
        if ($data) {
            $this->deleteImage($data);
            if ($this->billboardRepository->destroy($id)) {
                return true;
            }
            return false;
        }
        return false;
    }

    private function uploadImage($data)
    {
        $file_gambar = $data['foto']->getClientOriginalName();
        $file_name_asli = Str::slug(pathinfo($file_gambar, PATHINFO_FILENAME));
        $name = uniqid() . $file_name_asli . '.' . $data['foto']->getClientOriginalExtension();
        $data['foto']->move($_SERVER['DOCUMENT_ROOT'] . '/images', $name);
        return $name;
    }

    private function deleteImage($data)
    {
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/images/' . $data['foto']) && isset($data['foto'])) {
            unlink($_SERVER['DOCUMENT_ROOT'] . '/images/' . $data['foto']);
        }
    }
}
