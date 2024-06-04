<?php

namespace App\Provider\BinProvider;

use App\Interface\BinProvidersInterface;


class BinListProvider implements BinProvidersInterface
{

    public function __construct()
    {
        //to do
    }

    public function getStateName($api_connection_result)
    {
         #if 429 error  JPY
        /*$state = 'DE';
        $state = 'JPY';
        $state = 'LT';*/
        $rows = json_decode($api_connection_result["content"], true);
        if ($rows) {
            $state = $rows['country']['alpha2'];
        }
        
        return $state;       
    }
}
