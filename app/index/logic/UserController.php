<?php
namespace Multiple\Index\Logic;
use Multiple\Index\Model\PhalconUser;
use \Phalcon\MVC\Controller;
/**
* 
*/
class UserController extends Controller
{
	public function validateUserName($userName) : bool
	{
		if (strlen($userName) > 12 || strlen($userName) < 4) {
			return false;
		}

		if (!empty(PhalconUser::findFirst("name = '{$userName}'")))
		{
			return false;
		}
		
		return true;
	}

	public function registerUser($data) : bool
	{
		if (!$this->validateUserName($data['name']) || ($data['Password'] !== $data['password2'])) {
			return false;
		}

		$user = new PhalconUser();
		$user->name = $data['name'];
		$user->passwd = md5($data['Password']);
		$user->phone = $data['phone'];
		return $user->save();
	}

	public function validateUserLogin($data)
	{
		$res = PhalconUser::find(
			  array(
			  		'name  = :name: AND passwd = :passwd:',
			  		'bind' => $data,
			  )
		);
		if (empty($res->toArray()) || count($res->toArray()) > 1)
		{
			return false;
		}

		$this->session->set('userId', $res->toArray()[0]['id']);
		return true;
	}
}

?>