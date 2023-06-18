<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function menuToContent(){
        return $this->hasOne(ContentMenu::class, 'id_menu', 'id');
    }
    
    public function menuToSubMenu(){
        return $this->hasMany(SubMenu::class, 'id_menu', 'id');
    }
}
