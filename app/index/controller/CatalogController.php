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
			'catalog_name' => trim($this->request->getPost('catalog_name', 'string')),
		];

		$book = new \logic\user\Book();
		$result = $book->addUserCatalog($this->session->get('userId'), $data);
		return $this->refreshUrl('/index/main/index', $result);
	}
}
?>