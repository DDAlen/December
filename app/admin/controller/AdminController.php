<?php
namespace Multiple\Admin\Controller;
use \Phalcon\Mvc\Controller;
class IndexController extends Controller 
{
    public function indexAction()
    {
        echo "<h1>Hello admin!</h1>";
    }
}
?>