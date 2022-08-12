<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use function Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function loginAdmin() {
        if (Auth::check()) {
            return Redirect::route('home');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

//        $request->session()->invalidate();

//        $request->session()->regenerateToken();
        return Redirect::route('login');
    }

    public function index() {
        return view('login');
    }

    public function checkLogin(Request $request) {
        $arr = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $checkbox = $request->has('item_checkbox')? true : false;

        if (Auth::attempt($arr, $checkbox)) {
            return Redirect()->route('home');
        } else {
            return back()->withInput()->with('mess', 'Tài khoản hoặc mật khẩu không chính xác');
        }

    }
}
