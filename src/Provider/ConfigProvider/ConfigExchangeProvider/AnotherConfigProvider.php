<?php

namespace App\Provider\ConfigProvider\ConfigExchangeProvider;

require_once './config/exchangeconfig/another_api_config.php';

class AnotherConfigProvider extends ExchangeConfigProvider
{
    

    public function __construct()
    {
        $this->exchange_api_url = EXCHANGE_API_URL;
        $this->exchange_api_additional_param = EXCHANGE_API_ADDITIONAL_PARAM;
    }
}