<?php
namespace Multiple\Index\Logic;
use Multiple\Index\Model\PhalconUser;
/**
* 
*/
class UserController 
{
	public function validateUserName($userName) : bool
	{
		if (strlen($userName) > 12) {
			return false;
		}

		if (!empty(PhalconUser::findFirst("name = '{$userName}'")))
		{
			return false;
		}
		
		return true;
	}

	public function registerUser()
	{
		
	}
}

?>