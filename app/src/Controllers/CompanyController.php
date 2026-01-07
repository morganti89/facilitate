<?php

namespace App\Facilitate\Controllers;

use App\Facilitate\Controllers\Controller;
use App\Facilitate\Facades\Auth;
use App\Facilitate\Facades\Request;
use App\Facilitate\Models\CompanyModel;
use App\Facilitate\Services\Session;
use App\Facilitate\Services\SystemDate;

class CompanyController extends Controller
{

    private array $data = [];

    public function index(): void
    {
        render_view('company/form');
    }

    public function create(): void
    {
        $this->data = Request::getRequest()->post();

        try {
            $addressController = new AddressController($this->data);
            $this->data['address_id'] = $addressController->create();
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }

        try {
            $this->companyData();
            $this->data['company_id'] = CompanyModel::getInstance()->save();
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }

        try {
            $userController = new UserController($this->data);
            $lastId = $userController->create();
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }

        if ($lastId) {
            Session::new(['company_id' => $this->data['company_id']]);

            Auth::getInstance()
                ->authenticate()
                ->redirect('/');
        }
    }

    public function companyData(): void
    {
        $data = [
            'company_name' => $this->data['company_name'],
            'social_name' => $this->data['social_name'],
            'cnpj' => $this->data['cnpj'],
            'company_email' => $this->data['company_email'],
            'fone' => '',
            'create_at' => SystemDate::date(),
            'update_at' => SystemDate::date(),
            'address_id' => $this->data['address_id']
        ];
        self::proccessRequest($data, true);
    }
}
