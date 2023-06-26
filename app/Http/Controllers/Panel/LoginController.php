<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function create()
    {
        return view('panel.login');
    }

    public function login(Request $request)
    {
        $admin = Admin::where('email', $request->email)->first();
        if (empty($admin)) {
            return redirect()->back()->with('user_not_found', __('User not found!'));
        } else {
            if (Hash::check($request->password, $admin->password)) {
                Auth::login($admin);
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->back()->with('incorrect_password', __('Incorrect password'))->withInput();
            }
        }
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return redirect()->route('login.form');
    }
}
