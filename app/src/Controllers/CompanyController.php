<?php 

namespace App\Facilitate\Controllers;

use App\Facilitate\Controllers\Controller;
use App\Facilitate\Facades\Auth;
use App\Facilitate\Facades\Request;
use App\Facilitate\Models\CompanyModel;
use App\Facilitate\Services\Session;
use App\Facilitate\Services\SystemDate;

class CompanyController extends Controller{

    private $address;

    public function index(): void {
        render_view('company/form');
        
    }

    public function create(): void {
        $request = Request::getRequest()->post();

        //ADDRESS
        $address = $this->addressData($request);
        $addressController = new AddressController();
        $request['address_id'] = $addressController->create($address);
        
        //COMPANY
        $company = $this->companyData($request);
        self::proccessRequest($company, true);
        $request['company_id'] = CompanyModel::getInstance()->save();

        //USER
        $user = $this->userData($request);
        $userController = new UserController();
        $lastId = $userController->create($user);

        if ($lastId) {

            Session::new(['company_id'=> $lastId]);

             Auth::getInstance()
                ->authenticate()
                ->redirect('/');
        }

    }

    public function companyData($request): array{
        return [
            'company_name' => $request['company_name'],
            'social_name' => $request['social_name'],
            'cnpj' => $request['cnpj'],
            'company_email' => $request['company_email'],
            'fone' => '',
            'modules' => '',
            'create_at' => SystemDate::date(),
            'update_at' => SystemDate::date(),
            'address_id' => $request['address_id']
        ];
    }

    private function addressData($request): array{
        return [
            'public_place' => $request['public_place'],
            'number' => $request['number'],
            'neighborhood' => $request['neighborhood'],
            'city' => $request['city'],
            'state' => $request['state'],
            'country' => $request['country'],
            'zip_code' => $request['zip_code']
        ];
    }

    private function userData($request): array{
        return [
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => $request['password'],
            'company_id' => $request['company_id'],
            'admin' => 1,
            'create_at' => SystemDate::date(),
            'update_at' => SystemDate::date(),
        ];

    }
}
