<?php

namespace Route\Facilitate;

use App\Facilitate\Controllers\CompanyController;
use App\Facilitate\Facades\Router;
use App\Facilitate\Controllers\HomeController;
use App\Facilitate\Controllers\UserController;
use App\Facilitate\Controllers\LoginController;
use App\Facilitate\Controllers\DashboardController;
use App\Facilitate\Controllers\FinanceController;
use App\Facilitate\Controllers\ModuleController;


Router::get('/', [HomeController::class, 'index']);
Router::get('login', [LoginController::class, 'form']);
Router::post('login', [LoginController::class, 'auth']);
Router::get('login/logout', [LoginController::class, 'logout']);

Router::get('company',[CompanyController::class,'index']);
Router::post('company',[CompanyController::class,'create']);

Router::get('user', [UserController::class, 'form']);
Router::post('user', [UserController::class, 'create']);
Router::get('dashboard', [DashboardController::class, 'index'])
    ->authRequired();

Router::get('finance/list', [FinanceController::class, 'list']);
Router::get('finance/add',[FinanceController::class, 'add']);
Router::post('finance/add',[FinanceController::class, 'create']);

Router::get('module',[ModuleController::class, 'index']);
Router::post('module/add', [ModuleController::class, 'create']);