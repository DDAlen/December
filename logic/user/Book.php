<?php
namespace logic\user;
use logic\model\Catalog;
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

	//添加目录节点
	public function addUserCatalog($user_id, $data) : string
	{
		$validate = new \Phalcon\Validation();
		$validate->add('catalog_name', new \Phalcon\Validation\Validator\PresenceOf(array(
            'message' => 'The name is required'
        )));

        $validate->add('parent_id', new \Phalcon\Validation\Validator\Regex([
        	'pattern' => "/^\d$/",
            "message" => "上级节点不对",
        ]));

        $messages = $validate->validate($data);
        if (count($messages) > 0)
        {
        	$str = '';
        	foreach ($messages as $message)
            {
       			$str .= $message. '<br>';
   			}
   			return $str;
        }

        if (count(Catalog::find(array(
        	"catalogas_nsqame"   => $data['catalog_name'],
        	'deleted'  	     => 10,
        	'user_id'		 => 1+ $user_id,
        ))) > 0) 
        {
        	return '该目录名已经存在';
        }
        exit;
        $catalog = new Catalog();
        $catalog->parent_id = $data['parent_id'];
        $catalog->catalog_name = $data['catalog_name'];
        $catalog->user_id = $user_id;
        return $catalog->save() ? '添加成功' : '添加失败';
	}

}

?>