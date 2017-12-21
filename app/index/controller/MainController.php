<?php
namespace Multiple\Index\Controller;
/**
* 
*/
class MainController extends \Phalcon\MVC\Controller
{

	public function initialize()
	{
		if (!$this->session->has('userId')) {
			return;
		}
	}

	public function indexAction()
	{
		echo 2;
	}
}
?>