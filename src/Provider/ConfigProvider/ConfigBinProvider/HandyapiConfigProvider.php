<?php

namespace App\Provider\ConfigProvider\ConfigBinProvider;

require_once './config/binconfig/handyap_api_config.php';

class HandyapiConfigProvider extends BinConfigProvider
{
    public function __construct()
    {
        $this->bin_api_url = BIN_API_URL;
    }
}