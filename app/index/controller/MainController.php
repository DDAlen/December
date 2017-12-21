<?php
namespace Multiple\Index\Controller;
/**
* 
*/
class MainController extends ControllerBase
{

	public function initialize()
	{
		if (!$this->session->has('userId')) {
			return;
		}
	}

	//主页面
	public function indexAction()
	{
		$book = new \logic\user\Book();
		$this->assign('catalogs', $book->getUserCatalog($this->session->get('userId')));
	}
}
?>