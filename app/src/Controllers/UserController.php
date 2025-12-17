<?php 

namespace App\Facilitate\Controllers;

use App\Facilitate\Controllers\Controller;
use App\Facilitate\Facades\Auth;
use App\Facilitate\Models\UserModel;

class UserController extends Controller{

    public function form() {
        render_view('user/form');
    }

    public function create($data): int {
        self::proccessRequest($data);
        return UserModel::getInstance()->save();
    }

    public function getUserBy(string $by): UserModel|null{
        $model = new UserModel();
        return $model->getUser($by);
    }

    public function getUser(): void{
        
    }
}
