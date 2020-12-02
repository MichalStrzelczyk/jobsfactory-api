<?php
declare(strict_types=1);

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Micro;

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/src');

require_once BASE_PATH . '/vendor/autoload.php';

try {
    /**
     * The FactoryDefault Dependency Injector automatically registers the services that
     * provide a full stack framework. These default services can be overidden with custom ones.
     */
    $di = new FactoryDefault();

    /**
     * Include Services
     */
    include BASE_PATH . '/config/services.php';

    /**
     * Get config service for use in inline setup below
     */
    $config = $di->getConfig();

    /**
     * Starting the application
     * Assign service locator to the application
     */
    $app = new Micro($di);

    /**
     * Include Application
     */
    include BASE_PATH . '/routes.php';

    /**
     * Handle the request
     */
    $app->handle($_SERVER['REQUEST_URI']);
} catch (\Exception $e) {
    $errorId = \uniqid('err_');
    $data =  \json_encode([
        'errorId' => $errorId,
        'datetime' => date('Y-m-d H:i:s'),
        'message' => $e->getMessage(),
        'line' => $e->getLine(),
        'file' => $e->getFile(),
        'code' => $e->getCode(),
        'trace' => $e->getTraceAsString(),
        'post' => $_POST,
        'get' => $_GET,
        'server' => $_SERVER,

    ], JSON_PRETTY_PRINT);

    $filename = date('Y-m-d').'.log';
    \file_put_contents(BASE_PATH.'/log/'.$filename, $data.PHP_EOL, FILE_APPEND);

    header('Content-Type: application/json');
    echo json_encode(['error'=>$errorId]);
}
