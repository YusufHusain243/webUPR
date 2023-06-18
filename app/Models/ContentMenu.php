<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentMenu extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function contentToMenu()
    {
        return $this->belongsTo(Menu::class, 'id_menu', 'id');
    }
}
