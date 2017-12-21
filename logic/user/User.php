<?php
namespace logic\user;
use Multiple\Index\Model\PhalconUser;

/**
* 
*/
class User
{
	//验证用户名是否已经存在
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

	//注册用户
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

	//用户登录验证
	public function validateUserLogin($data) : int
	{
		$res = PhalconUser::find(
			  array(
			  		'name  = :name: AND passwd = :passwd:',
			  		'bind' => $data,
			  )
		);

		if (empty($res->toArray()) || count($res->toArray()) > 1)
		{
			return 0;
		}

		return $res->toArray()[0]['id'];
	}

}

?>