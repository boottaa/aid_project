<?php

/**
 * Created by PhpStorm.
 * User: boott
 * Date: 09.03.2018
 * Time: 15:08
 */
namespace Aid\Model;

use Aid\Model\Base;
use Zend\Db\Adapter\AdapterInterface;
use Zend\InputFilter\InputFilter;
use Zend\Log\LoggerInterface;

class Users extends Base
{
    protected $table = 'users';

    protected $data = [
        'id' => null,
        'phone' => null,
        'email' => null,
        'password' => null,
        'fname'  => null,
        'lname' => null,
        'rating' => null,
        'is_deleted' => null,
        'status' => 1,
        'date_update' => null,
        'type' => '',//ENUM
    ];

    private $access;

    public function __construct(AdapterInterface $dbAdapter, LoggerInterface $logger, $isDebug = false)
    {
        $this->access = new ApiAccess($dbAdapter, $logger);
        parent::__construct($dbAdapter, $logger, $isDebug);
    }

    public function getApiAccess()
    {
        return $this->access;
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
                'name'     => 'phone',
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