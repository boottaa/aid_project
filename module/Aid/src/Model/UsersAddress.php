<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 05.04.18
 * Time: 16:26
 */
namespace Aid\Model;

use Aid\Model\Base;
use Zend\InputFilter\InputFilter;

class UsersAddress extends Base
{

    protected $table = 'users_address';

    protected $data = [
        'id_user' => null,
        'address'  => null,
        'is_deleted' => 0,
        'date_update' => null,
    ];


    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                'name'     => 'id_user',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'address',
                'required' => false,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 3,
                            'max'      => 1000,
                        ),
                    ),
                ),
            ));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}