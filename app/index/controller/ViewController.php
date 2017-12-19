<?php
namespace  Multiple\Index\Controller;
use Phalcon\Mvc\Controller;

/**
* 
*/
class ViewController extends Controller
{

	public function initialize()
	{
		//this−>view−>setTemplateBefore(′common′)和this->view->setTemplateAfter(‘common’)可以控制渲染顺序
		$this->view->setTemplateBefore('common'); 
	}

	public function indexAction($Id)
	{
	    $this->view->Id = $Id;
	}
}


?>