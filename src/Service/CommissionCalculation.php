<?php

namespace App\Service;

use App\Service\Helper;

class CommissionCalculation
{
    private $dto_configs;
    private $exchange_rate;

    public function __construct($dto_configs, $exchange_rate)
    {
        $this->dto_configs = $dto_configs;
        $this->exchange_rate = $exchange_rate;
    }


    /**
     * @param object $row
     * @param string $currency_state_name
     * @param bool $is_euro_bank_card
     * 
     * @return string
     */
    public function getCommissionByZone(object $row, string $currency_state_name, bool $is_euro_bank_card): string
    {
        $commission = 0;
        
        if ($is_euro_bank_card === true) {
            if ($row->currency == $this->dto_configs->euro_currency) {
                //echo "111: <br>";
                $commission = $this->getCommissionProcent($row->amount, "europe");
               
            } else {
                //echo "222: <br>";    
                $euro_currency_from_exchange = $this->euroCurrencyFromExchange($row);
                $commission = $this->getCommissionProcent($euro_currency_from_exchange, "europe"); 
                     
            }
        } else {
            if ($row->currency == $this->dto_configs->euro_currency) {
                //echo "000: <br>";
                $commission = $this->getCommissionProcent($row->amount, "no europe");
            } else {
                //echo "444: <br>";
                $euro_currency_from_exchange = $this->euroCurrencyFromExchange($row);
                $commission = $this->getCommissionProcent($euro_currency_from_exchange, "no europe");
            }
            
            
        }
        
        return $commission;
    }
    /**
     * @param object $row
     * 
     * @return float
     */
    private function euroCurrencyFromExchange(object $row): float
    {
        
        $rate = $this->exchange_rate[$row->currency];
       /* echo "currency: ".$row->currency."<br>";
        echo "row->amount: ".$row->amount."<br>";
        echo "rate: ".$rate."<br>";
*/
        $euro_value = $row->amount / $rate;
        return $euro_value;
    }
    /**
     * @param string $euro_currency
     * @param mixed $zone
     * 
     * @return float
     */
    private function getCommissionProcent(string $euro_currency, string $zone): float
    {
        if ($zone == "europe") {
            $percent = $this->dto_configs->commission_rate_euro_zone;
        } else {
            $percent = $this->dto_configs->commission_rate_no_euro_zone;
        }
        //echo "currency: ".$euro_currency."<br>";
        //echo "percent: ".$percent."<br>";
        $commission = $euro_currency * $percent / 100;
        $commission = $this->roundUp($commission, 2);
       // echo "commission: ".$commission."<br>";
        return $commission;
    }
    /**
     * @param mixed $value
     * @param mixed $precision
     * 
     * @return [type]
     */
    private function roundUp( $value, $precision ) 
    { 
        $pow = pow ( 10, $precision ); 
        return ( ceil ( $pow * $value ) + ceil ( $pow * $value - ceil ( $pow * $value ) ) ) / $pow; 
    } 
}