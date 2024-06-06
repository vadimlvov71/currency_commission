
<?php
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use App\DTO\DTOConfigs;
use App\Controller\AppController;
use App\Service\CommissionCalculation;
use App\Service\Helper;
use App\Service\ApiConnection;
use App\Entity\UserAgents;
use App\Factory\ConfigBinFactory;
use App\Factory\ConfigExchangeFactory;
use App\Factory\ExchangeFactory;
use App\Factory\BinFactory;


class AppControllerTest extends TestCase
{
    
    public function testindex()
    {
        $dto_configs = new DTOConfigs();
        $bin_configs = ConfigBinFactory::create($dto_configs);
        $api_exchange_configs = ConfigExchangeFactory::create($dto_configs);
        $random_user_agent = UserAgents::randomValue();
        $path_to_file = getenv('PATH_TO_FILE');
    
        $api_connection = new ApiConnection($bin_configs, $api_exchange_configs);
     
        #1 file exists 
        $this->assertFileExists($path_to_file);
         #2 file and readable:
        $this->assertFileIsReadable($path_to_file);
        
        #3 a list of euro banks:
        $helper = new Helper();
        $rows_from_file = $helper->getArrayOfObject($path_to_file);
        #4 a list is an array type:
        $this->assertIsArray($rows_from_file, "error: no array from file ");
        #5 a key of list has 'bin' :
        $this->assertArrayHasKey('bin',  (array)$rows_from_file[0], "error: the array from file has not key: bin ");
 
        $api_exchange_rate = $api_connection->getCurrenciesExchangeList($dto_configs);

        if ($dto_configs->exchange_url_type == "frankfurter") {
            #6 a list of currency exchange to euro:
            $this->assertIsArray($api_exchange_rate, "exchange error");
             #7 a key of list has 'http_code' :
            $this->assertArrayHasKey('rates',  (array)$api_exchange_rate, "error: key");
            //$this->assertArrayHasKey('http_code',  (array)$api_exchange_rate);
           // $this->assertThat($api_exchange_rate["http_code"], $this->equalTo("200"));
            //$this->assertArrayHasKey('content',  (array)$api_exchange_rate);
        } else {
            //another currency exchange provider
        }
       
        $exchange_factory = new ExchangeFactory();
        $exchange_provider = $exchange_factory->create($dto_configs->exchange_url_type);
        $exchange_rate = $exchange_provider->getExchangeRates($api_exchange_rate);
        #8 exchange rates is array:
        $this->assertIsArray($exchange_rate);
        #9 exchange rates is key 'USD':
        $this->assertArrayHasKey('USD',  (array)$exchange_rate, "error: the array has not key: usd ");
        
        #10 string from file 'bin' from is numeric:
        $this->assertTrue(is_numeric($rows_from_file[0]->bin)); 
        
        $api_connection_bin = $api_connection->getCountryCardByBin($rows_from_file[0]->bin);
        $bin_factory = new BinFactory();
        $bin_provider = $bin_factory->create($dto_configs->bin_url_type);
        
         #11 api bin string exists
        $this->assertIsString($api_connection_bin, "error: no string from API bin"); 
        if ($dto_configs->bin_url_type == "handyapi") {
            $substring = "SUCCESS";
        } else {
             //another bin provider
        }
        #12 string contains
        $this->assertStringContainsString($substring, $api_connection_bin, "bin response doesn't contains 'success' as substring") ;        
           
        $app_controller = new AppController($dto_configs);
        $result = $app_controller->index($path_to_file);
        #13 result array exists
        $this->assertIsArray( $result, "error: no array in return result");
        #14 result has success
        $this->assertArrayHasKey('success',  (array)$result);
    }
}
