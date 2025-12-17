<?php 

namespace App\Facilitate\Controllers;

use App\Facilitate\Controllers\Controller;
use App\Facilitate\Models\UserModel;
use App\Facilitate\Facades\Request;
use App\Facilitate\Models\FinanceModel;

class FinanceController extends Controller {

    public function add() {
        render_view('finance/form');
    }

    public function list() {

        
        $counts = $this->getAllCountsBy('company_id');

        render_view('finance/list',[
            'counts' => $counts
        ]);
    }

    public function create(){
        self::insertDate();
        $request['company_id'] = Request::getRequest()->get('company_id')['company_id'];
        self::proccessRequest($request);

        $lastId = FinanceModel::getInstance()->save();

        if ($lastId) {
            redirect('dashboard');
        }
    }

    public function getAllCountsBy(string $by): array|null {
        return FinanceModel::getInstance()->getAllBy($by);
    }
}
