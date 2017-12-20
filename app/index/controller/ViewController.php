<?php
namespace  Multiple\Index\Controller;
use \Phalcon\Mvc\Controller;
use Phalcon\MVC\View;

/**
* 
*/
class ViewController extends Controller
{

	public function initialize()
	{
		//this−>view−>setTemplateBefore(′common′)和this->view->setTemplateAfter(‘common’)可以控制渲染顺序
		$this->view->setTemplateAfter('common'); 
	}

	public function indexAction($Id)
	{
		$this->view->Id = $Id;
	}

	public function reuseAction($Id)
	{
		$this->view->pick("Index/index");
   		$this->view->Id = $Id;
	}

	public function validateAction($id, $string, $email)
	{
		$filter = new \Phalcon\Filter();
		 $price = $this->request->get("price", "double");
		echo '<br />' . $filter->sanitize($id, 'int');
		echo '<br />' . $filter->sanitize($string, 'string');
		echo '<br />' . $filter->sanitize($email, 'email');
	}

	public function disableAction()
	{
		$this->view->disableLevel(View::LEVEL_MAIN_LAYOUT);
	}
}


?>