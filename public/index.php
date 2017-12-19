<?php

use Phalcon\Mvc\Router;
use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Session\Adapter\Files as Session;
use Phalcon\Config\Adapter\Php  as ConfigPhp;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

define('DS', DIRECTORY_SEPARATOR);
defined('APP_PATH') or define('APP_PATH', dirname($_SERVER['SCRIPT_FILENAME']) . DS);
defined('ROOT_PATH') or define('ROOT_PATH', dirname(realpath(APP_PATH)) . DS);

// 读取配置
$config = new ConfigPhp(ROOT_PATH . str_replace('\\', DS, "app/Config/config.php"));
$di = new FactoryDefault();
// 初始化数据库连接 从配置项读取配置信息
$di->set('db', function () use ($config) {
    return new DbAdapter(array(
        "host"     => $config->database->host,
        "username" => $config->database->username,
        "password" => $config->database->password,
        "dbname"   => $config->database->dbname
    ));
});


//实例化session并且开始 赋值给DI实例 方便在控制器中调用
$di->setShared('session', function () {
    $session = new Session();
    $session->start();
    return $session;
});

// Specify routes for modules
$di->set(
    'router',
    function () {
        $router = new Router();
        $router->setDefaultModule('index');

        $router->notFound(array(  
            'module' => 'index',  
            'controller' => 'index',  
            'action' => 'index',  
        ));  

        $router->add('/:module', array(  
            'module' => 1,  
            'controller' => 'index',  
            'action' => 'index',  
        ));  

        $router->add('/:module/:controller', array(  
            'module' => 1,  
            'controller' => 2,  
            'action' => 'index',  
        ));  

        $router->add('/:module/:controller/:action', array(  
            'module' => 1,  
            'controller' => 2,  
            'action' => 3,  
        ));  

        $router->add('/:module/:controller/:action/:params', array(  
            'module' => 1,  
            'controller' => 2,  
            'action' => 3,  
            'params' => 4,  
        )); 

        return $router;
    }
);

// Create an application
$application = new Application($di);

// Register the installed modules
$application->registerModules(
    [
        'index' => [
            'className' => 'Multiple\Index\Module',
            'path'      => '../app/index/Module.php',
        ],
        'admin'  => [
            'className' => 'Multiple\Admin\Module',
            'path'      => '../app/admin/Module.php',
        ]
    ]
);

try {
    // Handle the request
    $response = $application->handle();

    $response->send();
} catch (\Phalcon\Exception $e) {
    echo '<pre>';
    var_dump($e);
    echo '<pre />'; 
    echo '<br />';
 	echo "PhalconException: ", $e->getMessage();
}

?>