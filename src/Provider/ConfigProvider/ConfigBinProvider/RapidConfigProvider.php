<?php

namespace App\Provider\ConfigProvider\ConfigBinProvider;

require_once './config/binconfig/rapid_api_config.php';

class RapidConfigProvider extends BinConfigProvider
{
    public function __construct()
    {
        $this->bin_api_key = BIN_API_KEY;
        $this->bin_api_host = BIN_API_HOST;
        $this->bin_api_url = BIN_API_URL;
        $this->bin_api_username = "";
        $this->bin_api_password = "";
        $this->bin_api_token = "";
        $this->bin_addditional1 = "";
        $this->bin_addditional2 = "";
        $this->bin_headers = $this->setHedears();
    }
    private function setHedears()
    {
        $headers = [];
        $headers[BIN_HEADERS_KEY1] = BIN_API_KEY;
        $headers[BIN_HEADERS_KEY2] = BIN_API_HOST;
        return $headers;
    }
}
