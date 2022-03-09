<?php

require_once 'debug.php';
require_once 'vendor/autoload.php';
require_once 'config/db.php';

use Core\Database;
use Core\Router;
use Migrations\Migrate;


session_start();

$router=new Router;
$router->run();
