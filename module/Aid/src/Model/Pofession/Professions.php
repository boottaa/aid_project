<?php

/**
 * Created by PhpStorm.
 * User: boott
 * Date: 09.03.2018
 * Time: 15:08
 */
namespace Aid\Model\Pofession;

use Zend\InputFilter\InputFilter;

class Professions
{
    public $id_profession;
    public $title;
    public $date_create;
    public $is_deleted;

    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->id_profession  = (!empty($data['id_profession'])) ? $data['id_profession'] : null;
	    $this->title          = (!empty($data['title'])) ? $data['title'] : null;
        $this->date_create    = (!empty($data['date_create'])) ? $data['date_create'] : null;
        $this->is_deleted     = (!empty($data['is_deleted'])) ? $data['is_deleted'] : '0';
        //FOR TESTING
        return $this;
    }

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