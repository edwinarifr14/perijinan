<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogoutController extends Controller {

    public function index(Request $req, $entity) {
        $req->session()->forget('login');
        return $entity === 'admin'
            ? redirect('/admin/login')
            : redirect('/');
    }

}
