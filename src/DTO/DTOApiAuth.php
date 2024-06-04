<?php

namespace App\DTO;

class DTOApiAuth
{
    public string $api_username;
    public string $api_token;
    public bool $is_api_auth_used;
    /*

    */
    public function __construct()
    {
        $this->api_username = API_USERNAME;
        $this->api_token = API_TOKEN;
        $this->is_api_auth_used = IS_API_AUTH_USED;
    }
}