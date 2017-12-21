<?php
namespace Multiple\Index\Controller;

/**
* 
*/
class BookController extends ControllerBase
{
	public function initialize()
	{

		if (!$this->session->has('userId'))
		{
			return;
		}
	}

	public function indexAction()
	{
		
	}

	public function addBookAction()
	{
			
	}

	public function deleteBookAction()
	{

	}

	public function modiftyBookAction()
	{

	}
}
?>