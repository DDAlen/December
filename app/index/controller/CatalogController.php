<?php
namespace Multiple\Index\Controller;
/**
* 
*/
class CatalogController extends ControllerBase
{

	public function addCatalogAction()
	{
		if (!$this->session->has('userId')) 
		{
			return;
		}

		$data = [
			'parent_id' => $this->request->getPost('catalog_id', 'int'),
			'catalog_name' => $this->request->getPost('catalog_name', 'string'),
		];

		$book = \logic\user\Book();

	}
}
?>