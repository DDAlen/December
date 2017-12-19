<?php
namespace Multiple\Index;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\DiInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{
    /**
     * Register a specific autoloader for the module
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();

        $loader->registerNamespaces(
            [
                'Multiple\Index\Controller' => '../app/index/controller/',
                'Multiple\Index\Model'      => '../app/index/model/',
            ]
        );

        $loader->register();
    }

    /**
     * Register specific services for the module
     */
    public function registerServices(DiInterface $di)
    {
        // Registering a dispatcher
        $di->set(
            'dispatcher',
            function () {
                $dispatcher = new Dispatcher();
                $dispatcher->setDefaultNamespace('Multiple\Index\Controller');
                return $dispatcher;
            }
        );

$di->setShared('view', function (){
    $view = new \Phalcon\Mvc\View();
    //设置模板根目录
    $view->setViewsDir('../app/index/view/');
    //注册模板引擎
    $view->registerEngines(array(
        //设置模板后缀名
        '.phtml' => function ($view, $di){
            $volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);
            $volt->setOptions(array(
                //模板是否实时编译
                'compileAlways' => false,
                //模板编译目录
                'compiledPath' => ROOT_PATH . '/app'
            ));
            return $volt;
        },
    ));
    return $view;
});
        // Registering the view component
        // $di->set(
        //     'view',
        //     function () {
        //         $view = new View();

        //         $view->setViewsDir('../app/index/view/'); 

        //         return $view;
        //     }
        // );
    }
}