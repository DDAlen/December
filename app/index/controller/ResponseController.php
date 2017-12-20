<?php
namespace Multiple\Index\Controller;
use \Phalcon\MVC\Controller;

/**
* 
*/
class ResponseController extends Controller
{
	public function indexAction()
	{
		$this->response->redirect('index/index'); //跳转之后的代码不执行
		var_dump($response);
	}

	public function baiduAction()
	{
		//跳转外部连接，可以返回状态码
		$this->response->redirect("http://www.baidu.com", true, 302); 
	}

	public function returnAction()
	{
		//return类
		$this->response->appendContent('test');                          //添加一段返回类容
		$this->response->setJsonContent(array('Response' => 'ok'));      //返回一个json,参数必须是数组
		$this->response->setContent("<h1>Hello!</h1>");                  //返回需要显示在页面上的内容
		$this->response->setStatusCode(404, "Not Found");                //返回http请求状态,以及msg
		return $this->response->send();                                  //打印响应
	}
}

?>