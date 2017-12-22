<?php
namespace logic\validate;

/**
* 
*/
class CatalogValidate extends \Phalcon\Validation
{
	public function initialize()
	{
		 $this->add('catalog_name', new PresenceOf(array(
            'message' => 'The name is required'
        )));

        $this->add('parent_id', new RegexValidator([
        	'pattern' => "/^\d$/",
            "message" => "上级节点不对",
        ]));
	}
}
?>