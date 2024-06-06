<?php

namespace App\Provider\BinProvider;

use App\Interface\BinProvidersInterface;


class BinListProvider implements BinProvidersInterface
{

   
    public function getStateName(string $api_connection_result): string
    {
        $rows = json_decode($api_connection_result["content"], true);
        if ($rows) {
            $state = $rows['country']['alpha2'];
        }
        
        return $state;       
    }
}
