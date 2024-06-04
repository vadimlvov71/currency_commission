<?php
namespace App\Factory;

use App\Provider\BinProvider\BinListProvider;
use App\Provider\BinProvider\HandyapiBinListProvider;


class BinFactory
{
   
    public static function create(string $type): object 
    {
      
        if ('handyapi'){
            return new HandyapiBinListProvider();
        } else if ('binlist.net') {
            return new BinListProvider();
        } else {
            //TO DO
            return new WrongProvider();
        }
    }
}