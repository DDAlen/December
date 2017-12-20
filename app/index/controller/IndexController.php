<?php
namespace Multiple\Index\Controller;
use \Multiple\Index\Model\PhalconUser;

class IndexController extends \Multiple\Index\Controller\BaseController 
{
	public function indexAction()
	{
		$this->view->setVars([
			'login' => '/index/index/index',
			'register'  => '/index/index/register',
			'forgetPassWorld'  => '/index/index/forgetPassWorld',
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
		$this->view->setVars([
			'login' => '/index/index/index',
			'register'  => '/index/user/registerUser',
		]);
	}

	//忘记密码页面
	public function forgetPassWorldAction()
	{
		$this->view->setVars([
			'login' => '/index/index/index',
			'register'  => '/index/index/register',
		]);
	}
}
?>