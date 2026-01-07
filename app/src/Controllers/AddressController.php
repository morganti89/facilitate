<?php

namespace App\Facilitate\Controllers;

use App\Facilitate\Controllers\Controller;
use App\Facilitate\Facades\Request;
use App\Facilitate\Models\AddressModel;
use Exception;

class AddressController extends Controller
{

    private array $data = [];

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }
    public function create(): int
    {
        if (!$this->data) {
            //throw new Exception('Não foi passado dados para inserção');
        }

        $this->addressData();
        return AddressModel::getInstance()->save();
    }
    
    private function addressData(): void{
        $data = [
            'public_place' => $this->data['public_place'],
            'number' => $this->data['number'],
            'neighborhood' => $this->data['neighborhood'],
            'city' => $this->data['city'],
            'state' => $this->data['state'],
            'country' => $this->data['country'],
            'zip_code' => $this->data['zip_code']
        ];
        parent::proccessRequest($data, true);
    }
}
