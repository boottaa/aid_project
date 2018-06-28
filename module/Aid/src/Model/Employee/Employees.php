<?php

/**
 * Created by PhpStorm.
 * User: boott
 * Date: 09.03.2018
 * Time: 15:08
 */
namespace Aid\Model\Employee;

use Zend\InputFilter\InputFilter;

class Employees
{
    public $id_employee;
    public $fname;
    public $lname;
    public $email;
    public $rating;
    public $password;
    public $status;
    public $date_create;
    public $is_deleted;

    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->id_employee  = (!empty($data['id_employee'])) ? $data['id_employee'] : null;
        $this->fname        = (!empty($data['fname'])) ? $data['fname'] : null;
        $this->lname        = (!empty($data['lname'])) ? $data['lname'] : null;
        $this->email        = (!empty($data['email'])) ? $data['email'] : null;
        $this->rating       = (!empty($data['rating'])) ? $data['rating'] : null;
        $this->password     = (!empty($data['password'])) ? $data['password'] : null;
        $this->status       = (!empty($data['status'])) ? $data['status'] : '1';
        $this->date_create  = (!empty($data['date_create'])) ? $data['date_create'] : null;
        $this->is_deleted   = (!empty($data['is_deleted'])) ? $data['is_deleted'] : '0';
        //FOR TESTING
        return $this;
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {

            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                'name'     => 'fname',
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
                            'min'      => 2,
                            'max'      => 16,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'lname',
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
                            'min'      => 2,
                            'max'      => 16,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'email',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'EmailAddress',
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'password',
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
                            'min'      => 4,
                            'max'      => 100,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'status',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'id_employee',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));


            $inputFilter->add(array(
                'name'     => 'rating',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));


            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}