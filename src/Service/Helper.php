<?php
namespace App\Service;

/**
 * [a service class]
 */
class Helper
{

    /**
     * @param string $currency
     * @param array $currency_list
     * 
     * @return bool
     */
    public static function isEuroBankCardEmitted(string $currency, array $currency_list): bool
    {
        return in_array($currency, $currency_list, true);
    }
    
    /**
     * @param string $file_with_data
     * 
     * @return array
     */
    public static function getArrayOfObject(string $file_with_data): array
    {
        $rows_as_json = [];
        $data_from_file = file_get_contents($file_with_data);
        $rows_from_file = explode("\n", trim($data_from_file));
        foreach ($rows_from_file as $row) {
            $rows_as_json[] = json_decode($row);    
        }
        return $rows_as_json;
    }
    /**
     * @param string $url
     * @param string $bin_url_type
     * @param string $random_user_agent
     * 
     * @return array
     */
    public static function getCountryCard(string $url, string $bin_url_type, string $random_user_agent)
    {

        $rows_as_json = Curl::getApiUrl($url, $random_user_agent);
        $rows = json_decode($rows_as_json["content"], true);

        if ($rows) {
            $state = self::getFormattedData($rows, $bin_url_type);
        }
        
        return $state;
        
    }
    public static function getCurrenciesList(string $url, string $exchange_url_type, string $random_user_agent)
    {
        
        $rows_as_json = Curl::getApiUrl($url, $random_user_agent);
        $rows = @json_decode($rows_as_json["content"], true);

        return $rows = self::getFormattedData($rows, $exchange_url_type);
    }
   
}