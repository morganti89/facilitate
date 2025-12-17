<?php

namespace App\Facilitate\Controllers;

use App\Facilitate\Facades\Request;
use App\Facilitate\Services\SystemDate;

class Controller
{


    //Função necessária para processos em que o formulário passa valores 
    //para dois modelos distintos (composição)
    /**     
     * Insere os dados passados no $data para a estrutura de Request
     * @param array $data
     * @return void
     */
    public static function proccessRequest(array $data, bool $nullable = false): void
    {
        Request::getRequest()->insert_post($data, $nullable);
    }

    public static function insertDate()
    {
        Request::getRequest()->insert_post([
            'create_at' => SystemDate::date(),
            'update_at' => SystemDate::date()
        ]);
        
    }
}
