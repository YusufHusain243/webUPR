<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function subMenuToContent(){
        return $this->hasOne(ContentSubMenu::class, 'id_sub_menu', 'id');
    }
    
    public function subMenuToMenu(){
        return $this->belongsTo(Menu::class, 'id_menu', 'id');
    }
}
