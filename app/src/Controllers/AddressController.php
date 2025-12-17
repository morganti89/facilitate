<?php 

namespace App\Facilitate\Controllers;

use App\Facilitate\Controllers\Controller;
use App\Facilitate\Models\AddressModel;

class AddressController extends Controller{

    public function create(array $data): int{
        self::proccessRequest($data);
        return AddressModel::getInstance()
            ->save();
    }
}
