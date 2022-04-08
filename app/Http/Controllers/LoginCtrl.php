<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

class LoginCtrl extends Controller
{
    public function logout(){
        Auth::logout();
        return route('login');
    }
}
