<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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

    public function index() {
        return view('login');
    }

    public function checkLogin(Request $request) {
//        dd(bcrypt('123'));
        $arr = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $checkbox = $request->has('item_checkbox')? true : false;

        if (Auth::attempt($arr, $checkbox)) {
            return Redirect()->route('home');
        } else {
            return Redirect::route('login');
        }

    }
}
