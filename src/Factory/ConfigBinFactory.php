<?php
namespace App\Factory;

use App\Provider\ConfigProvider\ConfigBinProvider\RapidConfigProvider;
use App\Provider\ConfigProvider\ConfigBinProvider\BinListConfigProvider;
use App\Provider\ConfigProvider\ConfigBinProvider\HandyapiConfigProvider;
use App\Interface\ConfigProvidersInterface;

class ConfigBinFactory 
{
   
    public static function create(object $dto_configs): object 
    {

        if ($dto_configs->bin_url_type == 'rapidapi'){
            return new RapidConfigProvider();
        } else if ($dto_configs->bin_url_type == 'binlist') {
            return new BinListConfigProvider();
        } else if ($dto_configs->bin_url_type == 'handyapi') {
            return new HandyapiConfigProvider();
        } else {
            //TO DO
            return new WrongConfigBinProvider();
        }
    }
}