<?php 

namespace App\Facilitate\Controllers;

use App\Facilitate\Controllers\Controller;
use App\Facilitate\Facades\Request;
use App\Facilitate\Models\UserModel;
use App\Facilitate\Services\SystemDate;

class UserController extends Controller{

    private array $data = [];

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function form() {
        render_view('user/form');
    }

    public function create(): int {
        $this->userData();
        return UserModel::getInstance()->save();
    }
    
    public function getUserBy(string $by): UserModel|null{
        $model = new UserModel();
        return $model->getUser($by);
    }
    
    public function getUser(): void{
        
    }
    
    private function userData(): void{
        $data = [
            'name' => $this->data['name'],
            'email' => $this->data['email'],
            'password' => $this->data['password'],
            'company_id' => $this->data['company_id'],
            'type' => 1,
            'create_at' => SystemDate::date(),
            'update_at' => SystemDate::date(),
        ];
        self::proccessRequest($data, true);

    }
}
