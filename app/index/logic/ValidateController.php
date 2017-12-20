<?php
namespace Multiple\Index\Logic;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;

/**
* 
*/
class ValidateController extends Validation
{
	public function initialize()
    {
        $this->add('name', new PresenceOf(array(
            'message' => 'The name is required',
            'cancelOnFail'=> true,
        )));
    }
}

?>