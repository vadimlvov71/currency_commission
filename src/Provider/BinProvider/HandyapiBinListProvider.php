<?php

namespace App\Provider\BinProvider;
use App\Interface\BinProvidersInterface;

class HandyapiBinListProvider implements BinProvidersInterface
{

    public function getStateName(string $api_connection_result): string
    {

        $row = json_decode($api_connection_result, true);

        if ($row) {
            $state = $row["Country"]["A2"];
        }
        return $state;       
    }
}
