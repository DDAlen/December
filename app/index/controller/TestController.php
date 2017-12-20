<?php
namespace Multiple\Index\Controller;
use \Phalcon\Mvc\Controller;
use Multiple\Index\Model\PhalconUser;

class TestController extends Controller 
{
    //创建控制器对象的后面执行一些初始化的逻辑
	public function onConstruct()
	{
    	echo '<h1>onConstruct!</h1>';
	}

	//beforeExecuteRoute:钩子函数在控制器被找到之前执行优先级高于initialize
	public function beforeExecuteRoute($dispatcher)
	{
    	echo '<h1>beforeExecuteRoute!</h1>';
	}

	#afterExecuteRoute:钩子函数在控制器执行完之后执行
	public function afterExecuteRoute($dispatcher) 
	{
	    echo '<h1>afterExecuteRoute!</h1>';
	}

	//调用任意方法之前调用 
	public function initialize()
	{
	    echo '<h1>initialize!</h1>';
	}

    public function indexAction()
    {
    	$this->view->setVar('test', 'hello world');
    	$this->session->set('username', 'phalcon');
        echo "<h1>Hello insdex!</h1>";
    }

    public function testAction($first, $second, $third = 'phalconTest')
    {	
    	$this->echoEx($first);
    	$this->echoEx($second);
    	echo "<h1>test url!</h1>";
    }

    public function errorAction()
    {
    	$this->flash->error("当前用户尚无访问权限!");

		$response->redirect("Request/Index");       
	    // 跳转到指定的控制器和方法 之后的代码一样会执行
	    return $this->dispatcher->forward(array(
	        "controller" => "index",
	        "action"     => "test",
	        'params'	 => ['sdf', 'sdcx'],
	    ));

    	echo '<h1>Controller/index2!</h1>';
    }

    public function sessionAction()
    {
	    $this->session->set('phalcon', 'test');                            // 以和服务相同名字的类属性访问

	    echo $this->di->getsession()->get('phalcon') . '</br>';            // 另一种方式：使用魔法getter来访问
	    echo $this->di->get('session')->get('phalcon') . '</br>';          // 通过DI访问服务
	    echo $this->di['session']->get('phalcon') . '</br>';               // 使用数组下标
	    echo $this->getDI()->getsession()->get('phalcon') . '</br>';       // 通过getDI方法获取实例
  		echo $this->session->get('phalcon') . '</br>'; 
	    echo '<h1>Controller/sessionAction!</h1>';
	}

	public function insertUserAction()
	{
		$User = new PhalconUser();
   		//设置需要写入的数据
	    $User->name   = "phalcon";
	    $User->phone  = "13011111111";
	    $User->passwd = "passwd";
	    //执行操作
	    $ret = $User->save();

	    //save()方法返回一个布尔值，表示存储的数据是否成功。
	    if ($ret) {
	        echo "写入数据成功";
	    } else {
	        //如果插入失败处理打印报错信息
	        echo "写入数据库失败了";
	        foreach ($User->getMessages() as $message) {
	            echo $message->getMessage(), "<br/>";
	        }
	    }
	    echo '<h1>indexController/insert!</h1>';		
	}

	public function selectAction()
	{
		var_dump(PhalconUser::find("name like 'phalcon%'")->toArray());
		echo '<h1>indexController/select!</h1>';	
	}

	public function testLineAction()
	{
		$rs = PhalconUser::query()
		    ->where("name = :name:")
		    ->andWhere("phone  = 13011111111")
		    ->bind(array("name" => "phalcon"))
		    ->execute();

		foreach ($rs as $user) {
		    echo $user->name, "\n";
		    echo '</br>';
		}
	}

	public function updateUserAction()
	{
		$user = PhalconUser::findFirst(1);
		$user->phone = '111111';
		return $user->save() ? '成功' : '失败';
	}

	public function updateAction()
	{
		//这种方式会把其余的字段覆盖点
		$user = new PhalconUser();
		$user->id = 1;
		$user->name = 'ceshi';
		$res = $user->save();
		if ($res)
		{
			return '成功';
		}
		else
		{
			 echo "写入数据库失败了";
	        foreach ($User->getMessages() as $message) {
	            echo $message->getMessage(), "<br/>";
	        }
		}
	}

	public function bindAction()
	{
		$params = ['name' => 'phalcon', 1 => '13011111111'];
		$res = PhalconUser::find(
			  array(
			  		'name  = :name: AND phone = ?1',
			  		'bind' => $params,
			  )
		);
		var_dump($res->toArray());
	}

	//多个绑定，不能忘记括号、
	public function bindMoreAction()
	{
		$array = ['phalcon', 'phalcon2'];
		$res = PhalconUser::find(
			array(
				'name in ({letter:array})',
				'bind' => ['letter' => $array],
			)
		);
		var_dump($res->toArray());
	}

	public function sumAction($phone = 'phalcon')
	{
		$array = ['phalcon', 'phalcon2'];;
		$sum = PhalconUser::sum(
		    array(
		        "column"     => "phone",
		        "conditions" => "name in ({letter:array})",
		        'bind'  	 => ['letter' => $array],
		    )
		);

		$min = PhalconUser::minimum(array(
				'column' => 'phone'
		));

		echo '</br>' . $sum;
		echo '</br>' . $min;
	}

}
?>