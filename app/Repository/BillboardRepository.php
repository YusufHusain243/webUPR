<?php

namespace App\Repository;

use App\Models\Billboard;

class BillboardRepository implements Repository
{
    public function index()
    {
        return Billboard::all();
    }

    public function store($data)
    {
        $billboard = new Billboard();
        return $billboard->create($data);
    }

    public function edit($id)
    {
        return Billboard::findOrFail($id);
    }

    public function update($data, $id)
    {
        $billboard = new Billboard;
        $billboard = $billboard::findOrFail($id);
        return $billboard->update($data);
    }

    public function destroy($id)
    {
        $billboard = new Billboard;
        $billboard = $billboard::findOrFail($id);
        return $billboard->delete();
    }
}
