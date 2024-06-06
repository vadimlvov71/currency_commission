<?php

namespace App\Interface;
 

interface BinProvidersInterface 
{

    public function getStateName(string $api_connection_result): string;
   
}
