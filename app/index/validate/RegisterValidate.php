<?php
namespace Multiple\Index\Validate;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex as RegexValidator;
use Phalcon\Validation\Validator\Confirmation;
/**
* 
*/
class RegisterValidate extends Validation
{
	public function initialize()
	{
		 $this->add('name', new PresenceOf(array(
            'message' => 'The name is required'
        )));

        $this->add('phone', new RegexValidator([
        	'pattern' => "/^1[34578]\d{9}$/",
            "message" => "The phone date is invalids",
        ]));

        $this->add('Password', new PresenceOf(array(
            'message' => 'The name is required'
        )));
	}
}

?>