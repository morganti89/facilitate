<?php 

namespace App\Facilitate\Controllers;

use App\Facilitate\Controllers\Controller;
use App\Facilitate\Facades\Auth;

class HomeController extends Controller{

    public function index() {

        if (Auth::getInstance()->isAuth()){
            redirect('dashboard');
            return;
        }
        render_view('home/index');
    }
}
