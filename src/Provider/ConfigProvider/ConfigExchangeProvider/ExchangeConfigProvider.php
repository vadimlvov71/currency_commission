<?php

namespace App\Provider\ConfigProvider\ConfigExchangeProvider;


class ExchangeConfigProvider
{
    
    public string $exchange_api_url;
    public string $exchange_api_additional_param;

    public function __construct()
    {
        $this->exchange_api_url = BIN_API_KEY;
        $this->exchange_api_additional_param = BIN_API_HOST;
    }
}