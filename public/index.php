<?php

use app\route;
ini_set('display_errors', 1);

require_once '../vendor/autoload.php';  
require_once '../app/config/config.php';
require_once '../app/core/loader.php';

$loader = new loader();
spl_autoload_register([$loader, 'loadClass']);

route::start();

?>
