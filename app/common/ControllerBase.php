<?php
namespace Multiple\Index\Controller;
use \Phalcon\Mvc\Controller;

/**
* 
*/
class ControllerBase extends Controller
{
	protected function echoEx($str)
	{
		echo $str . '<br />';
	}

	protected function assign($data, $value)
	{
		if(is_array($data)) {
			$this->view->setVars($data);
		} else {
			$this->view->setVar($data, $value);
		}
	}
	
	protected function refreshUrl($url, $message, $time = 3)
	{
		$filte = new \Phalcon\Filter();
		$this->view->setVars([
			'url' => $url,
			'message' => $message,
			'time'    => $filte->sanitize($time, 'int'),
		]);
		return $this->view->pick("location/index");
	}
}

?>