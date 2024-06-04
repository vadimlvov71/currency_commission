
<?php
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use App\DTO\DTOConfigs;
use App\Controller\AppController;
use App\Service\CommissionCalculation;
use App\Service\Helper;
use App\Service\ApiConnection;
use App\Entity\UserAgents;
use App\Factory\ExchangeFactory;

class AppControllerTest extends TestCase
{
    
    
    public function testindex()
    {
        $random_user_agent = UserAgents::randomValue();
        $path_to_file = getenv('PATH_TO_FILE');
        $dto_configs = new DTOConfigs();
        echo "path_to_file:".$path_to_file.PHP_EOL;
        $app_controller = new AppController($dto_configs);
        $api_connection = new ApiConnection();
     
   
        #1 file exists and readable:
        $this->assertFileExists($path_to_file);
        $this->assertFileIsReadable($path_to_file);
 
        #2 a list of euro banks:
        $helper = new Helper();
        $rows_from_file = $helper->getArrayOfObject($path_to_file);
        $this->assertIsArray($rows_from_file, "error: no array from file ");
        $this->assertArrayHasKey('bin',  (array)$rows_from_file[0], "error: the array from file has not key: bin ");

        
     
/*
        #3 a list of currency exchange to euro:
        $api_exchange_rate = $api_connection->getCurrenciesExchangeList($dto_configs, $random_user_agent);
        if ($dto_configs->exchange_url_type == "exchange_source1") {
            $this->assertIsArray($api_exchange_rate);
            $this->assertArrayHasKey('http_code',  (array)$api_exchange_rate);
            $this->assertThat($api_exchange_rate["http_code"], $this->equalTo("200"));
            $this->assertArrayHasKey('content',  (array)$api_exchange_rate);
        } else {
            //another currency exchange provider
        }

        #4 exchange rates:
        $exchange_factory = new ExchangeFactory();
        $exchange_provider = $exchange_factory->create($dto_configs->exchange_url_type);
        $exchange_rate = $exchange_provider->getExchangeRates($api_exchange_rate);
        
        $this->assertIsArray($exchange_rate);
        $this->assertArrayHasKey('USD',  (array)$exchange_rate, "error: the array has not key: usd ");
        */
        #4 get api bin:
        echo "rows_from_file:".gettype($rows_from_file[0]->bin).PHP_EOL;
        $this->assertTrue(is_numeric($rows_from_file[0]->bin)); 
        
        $api_connection_bin = $api_connection->getCountryCardByBin($dto_configs, $rows_from_file[0]->bin, $random_user_agent);
        $this->assertIsArray($api_connection_bin, "error: no array from API bin");
        $this->assertArrayHasKey('http_code',  (array)$api_connection_bin);
        $this->assertThat($api_connection_bin["http_code"], $this->equalTo("200"));

        $result = $app_controller->index($path_to_file);
        $this->assertIsArray( $result, "error: no array in index result");
        $this->assertArrayHasKey('success',  (array)$result);
        //print_r($result);
        //$this->assertEquals('success2', $result);
        
        /*$mock = $this->getMockBuilder(ApiConnection::class)
            //->setConstructorArgs([$dto_configs])
            ->onlyMethods(['getCurrenciesExchangeList'])
            //->with($this->equalTo($path))
            ->getMock();
        
            //$this->assertEquals("23.47", $result);

       $mock->expects($this->once())
            ->method('getCurrenciesExchangeList')
            //->with($path_to_file)
            //->willReturn('success')
            ;
            */
        /*    
        
        */
        //print_r($api_exchange_rate);
        //$this->assertEquals("23.47", $result);
/*
   $mock->expects($this->once())
        ->method('test')
       // ->willReturn('success1111')
        ;
    $result = $mock->test();
    echo "result:".$result.PHP_EOL;
    $this->assertEquals("success", $result); 
       // $sut = new \ReflectionClass(AppController);
        //$prop1 = $sut->getProperty('param1');
       */
    }
}
 /*require_once  './config/env.php';
        $test_bin = [0 => "45717360"];
        $file_with_data = "./". FILE_WITH_DATA;
        $file_to_commission_result = "./".FILE_TO_COMMISSION;
        
        #1
        $mock = $this->createMock(AppController::class);
        $this->assertInstanceOf(AppController::class, $mock);

        #2
        $mock = $this->createMock(CommissionCalculation::class);
        $this->assertInstanceOf(CommissionCalculation::class, $mock);

        $api_exchange_rate = Helper::getArrayOfObject($file_with_data);

        #3
        $this->assertIsArray($api_exchange_rate);

        #4
        $this->assertArrayHasKey('bin',  (array)$api_exchange_rate[0]);
        #5
        
        $this->assertSame((array)$api_exchange_rate[0]->bin, $test_bin);
        
        #6
        $commission = "test test";
        $result = Helper::setDataToFile($commission, $file_to_commission_result);
        $this->assertArrayHasKey('success',  $result);
        */