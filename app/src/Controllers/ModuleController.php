<?php

namespace App\Facilitate\Controllers;

use App\Facilitate\Controllers\Controller;
use App\Facilitate\Models\ConfigModel;
use App\Facilitate\Models\ModuleModel;
use App\Facilitate\Models\UserModel;

class ModuleController extends Controller
{

    const TYPE_SUPER_USER = 3;

    public function index()
    {
        render_view('config/index');
    }

    public function create()
    {
        $lastId = ModuleModel::getInstance()->save();
        if ($lastId) {
            redirect('module');
        }
    }

    public function getAllModulesByTypeUser(UserModel $user): array|null
    {

        if ($user->getType() === self::TYPE_SUPER_USER) {
            return $this->getAllModules();
        }

        $modules = $user->getUserModules();
        return $this->parseModules($modules);
    }

    public function getAllModules(): array
    {
        $modules = ModuleModel::getInstance()->getAll();
        return $this->parseModules($modules);
    }

    private function parseModules(array $modules): array
    {
        $data = [];
        foreach ($modules as $module) {
            $aux = [];
            $aux['name'] = $module->getSubgroup();
            $aux['link'] = $module->getLink();
            $data[$module->getName()][] = $aux;
        }
        return $data;
    }
}
