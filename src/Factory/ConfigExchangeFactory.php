<?php
namespace App\Factory;

use App\Provider\ConfigProvider\ConfigExchangeProvider\FrankfurtConfigProvider;
use App\Provider\ConfigProvider\ConfigExchangeProvider\AnotherConfigProvider;
use App\Interface\ConfigProvidersInterface;

class ConfigExchangeFactory 
//implements ConfigProvidersInterface
{
   
    public static function create(object $dto_configs): object 
    {

        if ($dto_configs->exchange_url_type == 'frankfurter'){
            return new FrankfurtConfigProvider();
        } else if ($dto_configs->exchange_url_type == 'another') {
            return new AnotherConfigProvider();
        } else {
            //TO DO
            return new WrongConfigExchangeProvider();
        }
    }
}