<?php
namespace Multiple\Index\Controller;
use \Multiple\Index\Model\PhalconUser;

class IndexController extends \Multiple\Index\Controller\BaseController 
{
	public function indexAction()
	{
		$this->view->setVars([
			'login' => '/index/index/loginIn',
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
		if (!$this->request->isPost())	
		{
			$this->response->redirect("/index/index/index"); 
		}

		$data = [
			'name' => $this->request->getPost('userName', 'string'),
			'passwd' => md5($this->request->getPost('userPassword', 'string')),
		];

		$validate = new \Multiple\Index\Logic\UserController();
		if ($validate->validateUserLogin($data)) 
		{
			return $this->dispatcher->forward(array(
		        "controller" => "location",
		        "action" => "index",
		        'params'	 => ['/index/test/bind', '登录成功'],
	   		));
		}

		echo '<script type="text/javascript">alert(\'账号或密码错误\')</script>';
		return $this->dispatcher->forward(array(
		        "controller" => "index",
		        "action"     => "index",
   		));
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

	public function afterExecuteRoute($dispatcher) 
	{
		if ($this->request->isPost()) {
			$_POST = array();
		}
		if ($this->request->isGet()) {
			$_GET = array();
		}
	}
}
?>