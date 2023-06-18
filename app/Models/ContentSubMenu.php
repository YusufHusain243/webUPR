<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentSubMenu extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function subContentToMenu()
    {
        return $this->belongsTo(SubMenu::class, 'id_sub_menu', 'id');
    }
}
