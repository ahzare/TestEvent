<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if (Auth::check()) {
            return view('panel.admin.master');
        }
        return view('panel.login');
    }
}
