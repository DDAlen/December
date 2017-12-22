<?php
namespace Multiple\Index\Controller;
/**
* 
*/
class MainController extends ControllerBase
{

	//主页面
	public function indexAction()
	{
		$book = new \logic\user\Book();
		$this->assign('catalogs', $book->getUserCatalog($this->session->get('userId')));

		$this->assign('user_id', $this->session->get('userId'));
	}
}
?>