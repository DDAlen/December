<?php
namespace Multiple\index\Controller;
use \Phalcon\MVC\Controller;

/**
* 
*/
class UserController extends Controller
{
	public function indexAction()
	{

	}

	//注册功能
	public function registerUserAction()
	{
		if (!$this->request->isPost()) {
			$this->response->redirect("/index/index/index"); 
		}
		
		$data = [
			'name' => $this->request->getPost('userName', 'string'),
			'phone' => $this->request->getPost('phone', 'string'),
			'Password' => $this->request->getPost('password', 'string'),
			'password2' => $this->request->getPost('password2', 'string'),
		];

		$validate = new \Multiple\Index\Validate\RegisterValidate();
		$messages = $validate->validate($data);
		if (count($messages))
		{
			foreach ($messages as $message) {
        		echo $message, '<br>';
   			}
   			var_dump('注册失败');
   			return;
		}

		$user = new \Multiple\Index\Logic\UserController();
		if (!$user->registerUser($data)) {
			$this->response->redirect("/index/index/index"); 
		}
		$this->response->redirect("/index/index/index"); 		
	}

	//ajax验证用户名
	public function validateUserNameAction($userName)
	{
		$validate = new \Multiple\Index\Logic\ValidateController();
		$filter = new \Phalcon\Filter();
		$name = $filter->sanitize($userName, "string");
		if (count($validate->validate(['name' => $name])) > 0) {
			return json_encode('ERROR');
		}

		$user = new \Multiple\Index\Logic\UserController();
		if ($user->validateUserName($name))
		{
			return json_encode('SUCCESS');	
		}

		return json_encode('ERROR');
	}
}	

?>