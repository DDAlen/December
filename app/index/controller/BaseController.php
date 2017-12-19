<?php
namespace Multiple\Index\Controller;
use \Phalcon\Mvc\Controller;

/**
* 
*/
class BaseController extends Controller
{
	
	protected function echoEx($str)
	{
		echo $str . '<br />';
	}
}

?>