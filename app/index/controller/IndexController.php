<?php
namespace Multiple\Index\Controller;
use \Multiple\Index\Model\PhalconUser;

class IndexController extends ControllerBase
{
	public function indexAction()
	{
		$this->session->destroy();
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
		return $this->refreshUrl('/index/index/index', '退出登录成功');
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

		$validate = new \logic\user\User();
		$id = $validate->validateUserLogin($data);
		if ($id > 0) 
		{
			$this->session->set('userId', $id);
			return $this->refreshUrl('/index/main/index', '登录成功');
		}
			
		return $this->refreshUrl('/index/index/index', '账号或密码错误');
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