<?php 

namespace App\Facilitate\Controllers;

use App\Facilitate\Controllers\Controller;
use App\Facilitate\Controllers\UserController;
use App\Facilitate\Services\Redis;
use App\Facilitate\Services\Session;

class DashboardController extends Controller{

    public function index() {

        render_view(
            viewName: 'dashboard/index'
        );
    }
}
