<?php
namespace Multiple\Index\Controller;
/**
* 
*/
class MainController extends \Phalcon\MVCController
{

	public function initialize()
	{
		if (!$this->session->has('userId')) {
			return false;
		}
	}

	public function indexAction()
	{

	}


}
?>