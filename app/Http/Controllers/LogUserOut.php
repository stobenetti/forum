<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LogUserOut extends Controller {
    public function index() {
        Auth::logout();
        unset($_COOKIE['access_token']);
        setcookie('access_token', '', time() - 3600, '/');

        unset($_COOKIE['user_id']);
        setcookie('user_id', '', time() - 3600, '/');

        unset($_COOKIE['user_privilege']);
        setcookie('user_privilege', '', time() - 3600, '/');

        unset($_COOKIE['user_name']);
        setcookie('user_name', '', time() - 3600, '/');

        unset($_COOKIE['user_email']);
        setcookie('user_email', '', time() - 3600, '/');

        return redirect('/');
    }
}
