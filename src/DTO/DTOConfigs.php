<?php

namespace App\DTO;

require_once './env.php';

class DTOConfigs
{
    public string $file_with_data;
    public array $const_currency_list;
    public string $currency_url;
    public string $exchange_rate_url;
    public string $bin_url_type;
    public string $exchange_url_type;
    public string $euro_currency;
    public string $commission_rate_euro_zone;
    public string $commission_rate_no_euro_zone;
    public string $file_to_commission_result;

    public function __construct()
    {
        $this->file_with_data = FILE_WITH_DATA;
        $this->const_currency_list = CONST_COUNTRIES_CURRENCY_LIST;
        $this->currency_url = CURRENCY_URL;
        $this->exchange_rate_url = EXCHANGE_RATE_URL;
        $this->bin_url_type = BIN_URL_TYPE;
        $this->exchange_url_type = EXCHANGE_URL_TYPE;
        $this->euro_currency = EURO_CURRENCY;
        $this->commission_rate_euro_zone = COMMISSION_RATE_EURO_ZONE;
        $this->commission_rate_no_euro_zone = COMMISSION_RATE_NO_EURO_ZONE;
        $this->file_to_commission_result = FILE_TO_COMMISSION;
        
    }
}
