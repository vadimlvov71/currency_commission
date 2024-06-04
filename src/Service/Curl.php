<?php
namespace App\Service;

/**
 * [connect to remote API website with random user agents]
 */
class Curl
{
       /**
     * @param string $url
     * @param string $user_agent
     * 
     * @return array
     */
    public static function getApiUrl(object $api_configs, string $type): string
    {
       $headers = [];
        if ($type === "bin") {
            $url = $api_configs->bin_api_url."/".$api_configs->bin_api_bin;

            if (!empty($api_configs->bin_headers)) {
               /* $headers = [
                    'X-RapidAPI-Key: abe0fd0fe8msh38871e98b417093p1527b0jsnb245b4a06cf1',
                    'X-RapidAPI-Host: binlist.p.rapidapi.com'
                ];*/
            }

        } else {
            $url = $api_configs->exchange_api_url;
        }
        $ch = curl_init();
                
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);          
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
       
        $result     = curl_exec ($ch);
        return $result;
    }
    public static function getHeaders(string $type)
    {
        $headers = "";
        return $headers;
    }
             
}