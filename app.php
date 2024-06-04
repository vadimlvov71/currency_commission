<?php

use App\Controller\AppController;
use App\DTO\DTOConfigs;

require './vendor/autoload.php';

$configs = new DTOConfigs();
$app = new AppController($configs);
$result = $app->index("./".$argv[1]);


if (!empty($result["success"])) {        
    foreach ($result["success"] as $key => $item) { 
        echo $item;
    }
}
if (!empty($result["error"])) {        
    foreach ($result["error"] as $key => $item) { 
        echo $item;
    }
}

exit;

