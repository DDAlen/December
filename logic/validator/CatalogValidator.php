<?php
namespace logic\validator;
/**
* 
*/
class CatalogValidator extends \Phalcon\Validator
{
	public function validate($validator, $attribute)
    {
        $value = $validator->getValue($attribute);

        if (filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6)) {

            $message = $this->getOption('message');
            if (!$message) {
                $message = 'The IP is not valid';
            }

            $validator->appendMessage(new Message($message, $attribute, 'Ip'));

            return false;
        }

        return true;
    }
}

?>