<?php
namespace App\Service;
use App\DTO\DTOApiAuth;
/**
 * [a service class]
 */
class ApiConnection
{
    private $bin_configs;
    private $exchange_configs;

    public function __construct($bin_configs, $exchange_configs)
    {
        $this->bin_configs = $bin_configs;
        $this->exchange_configs = $exchange_configs;     
    }
    public function getCountryCardByBin(string $bin)
    {
        $this->bin_configs->bin_api_bin = $bin;
        $result = Curl::getApiUrl($this->bin_configs, "bin");
        //$result = '{"Status":"SUCCESS","Scheme":"VISA","Type":"DEBIT","Issuer":"YORKSHIRE BANK","CardTier":"CLASSIC","Country":{"A2":"GB","A3":"GBR","N3":"826","ISD":"44","Name":"United Kingdom","Cont":"Europe"},"Luhn":true}';
        //print_r($result);
       
        return $result;  
       /*return [
        'url' => 'https://lookup.binlist.net/4745030',
        'http_code' => 200,
        'errno' => 0,
        'content' => ''
        ] ;*/
 
        ///or another way  
    }

    public function getCurrenciesExchangeList(): array
    {
        
        $rows_as_json = Curl::getApiUrl($this->exchange_configs, "exchange");
        $result = json_decode($rows_as_json);
        $result = (array) $result;
       // print_r($result);
        //exit;
        ///or another way  
        return $result;
    }
}
