<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LogUserOut extends Controller {
    public function index() {
        Auth::logout();
        return redirect('/');
    }
}
