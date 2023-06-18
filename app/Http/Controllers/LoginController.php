<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        $menu = Menu::all();
        $setting = Setting::all();
        return view('admin/login',[
            "menu"=>$menu,
            "setting"=>$setting,
        ]);
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only(['email', 'password']))) {
            if (Auth::user()) {
                return redirect('/setting');
            } else {
                Auth::logout();
                return redirect('/login')->with('Error', 'Login Gagal');
            }
        }
        return redirect('/login')->with('Error', 'Login Gagal');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }
}
