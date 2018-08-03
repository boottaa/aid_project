<?php

/**
 * Created by PhpStorm.
 * User: boott
 * Date: 09.03.2018
 * Time: 15:08
 */
namespace Aid\Model;

use Aid\Model\Base;
use Zend\InputFilter\InputFilter;

class Professions extends Base
{
    protected $table = 'profession';

    protected $data = [
        'id_profession' => null,
        'title'  => null,
        'date_create' => null,
        'is_deleted' => 0,
    ];


    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                'name'     => 'title',
                'required' => true,
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
                            'max'      => 250,
                        ),
                    ),
                ),
            ));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}