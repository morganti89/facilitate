<?php 

namespace App\Facilitate\Controllers;

use App\Facilitate\Controllers\Controller;
use App\Facilitate\Controllers\UserController;
use App\Facilitate\Services\Redis;
use App\Facilitate\Services\Session;

class DashboardController extends Controller{

    public function index() {
        
        $userController = new UserController();
        $user = $userController->getUserBy('company_id');

        $moduleController = new ModuleController();
        $modules = $moduleController->getAllModulesByTypeUser($user);

        $rClient = Redis::getInstance()->connect()->getClient();

        if (!$rClient->get('modules_'.Session::get('company_id'))) {
            $rClient->set('modules_'.Session::get('company_id'), json_encode($modules));
        }

        render_view(
            viewName: 'dashboard/index',
            viewVariables: [
                'user' => $user->getUsername()
            ]
        );
    }
}
