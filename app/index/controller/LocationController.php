<?php
namespace Multiple\Index\Controller;
use \Phalcon\MVC\Controller;
/**
* 
*/
class LocationController extends Controller
{
	public function indexAction($url, $message, $time = 3)
	{
		$filte = new \Phalcon\Filter();
		$this->view->setVars([
			'url' => $url,
			'message' => $message,
			'time'    => $filte->sanitize($time, 'int'),
		]);
	}
}

?>