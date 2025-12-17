<?php

namespace App\Facilitate\Controllers;

use App\Facilitate\Controllers\Controller;
use App\Facilitate\Facades\Auth;
use App\Facilitate\Controllers\UserController;
use App\Facilitate\Facades\Request;

class LoginController extends Controller{

    public function form() {
        render_view('login/form');
    }

    public function auth() {
        $userController = new UserController();

        $data = Request::getRequest()->post();
        if (!$this->isUser($data['user'])) {
            self::proccessRequest(['email'=> $data['user']]);
            $data += Request::getRequest()->post();
        }
        $user = $userController->getUserBy(!$this->isUser($data['email']) ?'email': 'name');
        
        if ($user == null) {
            redirect('login');
        }

        if (password_verify( $data['password'], hash: $user->getPassword())) {
            Auth::authenticate()
                ->insertSessionData('company_id', $user->getCompanyId())
                ->redirect('dashboard');
            return;
        }
        
        redirect('login');
    }

    public function logout() {
        Auth::getInstance()->destroy();
    }

    private function isUser(string $user): bool{
        return strpos($user, '@') <= 0;
    }
}
