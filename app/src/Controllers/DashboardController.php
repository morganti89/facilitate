<?php 

namespace App\Facilitate\Controllers;

use App\Facilitate\Controllers\Controller;
use App\Facilitate\Controllers\UserController;
use App\Facilitate\Facades\Request;
use App\Facilitate\Services\Session;

class DashboardController extends Controller{

    public function index() {

        $userController = new UserController();
        $user = $userController->getUserBy('company_id');

        $moduleController = new ModuleController();
        $modules = $moduleController->getAllModules();

        render_view(
            viewName: 'dashboard/index',
            viewVariables: [
                'user' => $user->getUsername(),
                'modules' => $modules
            ]
        );
    }
}
