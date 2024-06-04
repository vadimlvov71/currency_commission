<?php

namespace App\Provider\BinProvider;


class HandyapiBinListProvider
{

    public function __construct()
    {
      
    }
    public function getStateName($api_connection_result)
    {
        //$state = "GBP";
        $row = json_decode($api_connection_result, true);

        //print_r($row);
        if ($row) {
            $state = $row["Country"]["A2"];
            //$state = $row->Country->A2;
        }
        //echo "state:".$state.PHP_EOL;
        return $state;       
    }
}
