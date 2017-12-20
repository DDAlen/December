<?php
namespace Multiple\Admin\Controller;
use \Phalcon\Mvc\Controller;
class IndexController extends Controller 
{
   public function indexAction()
	{
		$this->view->setVars([
			'login' => '/admin/index/index',
			'register'  => '/admin/index/register',
			'forgetPassWorld'  => '/admin/index/forgetPassWorld',
			'robs' => [['name' => 12],['name' => 22],['name' => 32],['name' => 42],['name' => 52],['name' => 62],['name' => 72]],
		]);
	}

	//退出登录操作
	public function loginOutAction()
	{
		$this->session->destroy();
	}

	//登录操作
	public function loginInAction()
	{
			
	}

	//注册页面  这种方法可以没有吗？
	public function registerAction()
	{

	}

	//忘记密码页面
	public function forgetPassWorldAction()
	{
		$this->view->setVars([
			'login' => '/admin/index/index',
			'register'  => '/admin/index/register',
		]);
	}
}
?>