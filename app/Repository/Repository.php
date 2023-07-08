<?php

namespace App\Repository;

interface Repository
{
    public function index();
    public function store($data);
    public function edit($id);
    public function update($data, $id);
    public function destroy($id);
}
