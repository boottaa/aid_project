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

class EmployeeProfessions extends Base
{

    protected $data = [
        'id_employee' => null,
        'id_profession'  => null,
        'date_create' => null,
        'is_deleted' => 1,
        'price' => null,
        'experience' => null,
        'description' => null,
    ];


    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                'name'     => 'id_employee',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'id_profession',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add([
                'name'     => 'price',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ]);

            $inputFilter->add(array(
                'name'     => 'experience',
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
                            'max'      => 100,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'description',
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
                            'max'      => 10000,
                        ),
                    ),
                ),
            ));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}