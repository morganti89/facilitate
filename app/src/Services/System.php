<?php

namespace App\Facilitate\Services;

use App\Facilitate\Controllers\ModuleController;
use App\Facilitate\Controllers\UserController;
use App\Facilitate\Services\Redis;
use App\Facilitate\Services\Session;

class System
{
    public static function getModulesAndUser(array &$variables): array
    {
        $userController = new UserController();
        $user = $userController->getUserBy('company_id');
        if (!$user) return $variables;

        $moduleController = new ModuleController();
        $modules = $moduleController->getAllModulesByTypeUser($user);
        $rClient = Redis::getInstance()->connect()->getClient();

        if (!$rClient->get('modules_' . Session::get('company_id'))) {
            $rClient->set('modules_' . Session::get('company_id'), json_encode($modules));
        }
        json_decode($rClient->get('modules_' . Session::get('company_id')), true);

        $variables['user']= $user;
        $variables['modules'] = $modules;
        return $variables;
    }
}
