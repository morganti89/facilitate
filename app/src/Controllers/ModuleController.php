<?php

namespace App\Facilitate\Controllers;

use App\Facilitate\Controllers\Controller;
use App\Facilitate\Models\ConfigModel;
use App\Facilitate\Models\ModuleModel;

class ModuleController extends Controller
{

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

    public function getAllModules(): array|null
    {

        $modules = ModuleModel::getInstance()->getAll();

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
