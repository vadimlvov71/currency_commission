<?php
namespace App\Factory;

use App\Provider\ExchangeProvider\FrankfurtProvider;
use App\Provider\ExchangeProvider\AnotherExchangeProvider;


class ExchangeFactory
{
   
    public static function create(string $type) 
    {
      
        if ('exchange_source1'){
            return new FrankfurtProvider();
        } else if ('exchange_source2') {
            return new AnotherExchangeProvider();
        } else {
            return new WrongProvider();
        }
    }
}