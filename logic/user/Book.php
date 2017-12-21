<?php
namespace logic\user;

/**
* 
*/
class Book
{
	//获取用户的目录结构 默认第一级
	public function getUserCatalog($user_id, $catalog_id = 0) : array
	{
		return \logic\model\Catalog::find([
			'user_id' 	=> $user_id,
			'parent_id' => $catalog_id,
			'deleted'  	=> 0,
		])->toArray();
	}

	//获取用户某一目录下的书
	public function getUserBooks($user_id, $catalog_id)
	{
		return \logic\model\Book::find([
			'user_id' 	=> $user_id,
			'catalog_id' => $catalog_id,
			'deleted'  	=> 0,
		])->toArray();
	}

}

?>