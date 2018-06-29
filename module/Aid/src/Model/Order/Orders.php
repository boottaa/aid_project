<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 07.03.18
 * Time: 15:00
 */
namespace Aid\Model\Order;

use Zend\InputFilter\InputFilter;

class Orders
{
	public $id_order;
	public $id_user;
	public $id_employee;
	public $status;
	public $address;
	public $phone;
	public $email;
	public $date_create;
	public $is_deleted;

    protected $inputFilter;

    public function exchangeArray($data)
	{
		$this->id_order     = (!empty($data['id_order'])) ? $data['id_order'] : null;
		$this->id_user      = (!empty($data['id_user'])) ? $data['id_user'] : null;
		$this->id_employee  = (!empty($data['id_employee'])) ? $data['id_employee'] : null;
		$this->status       = (!empty($data['status'])) ? $data['status'] : '1';
		$this->address      = (!empty($data['address'])) ? $data['address'] : null;
		$this->phone        = (!empty($data['phone'])) ? $data['phone'] : null;
		$this->email        = (!empty($data['email'])) ? $data['email'] : null;
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
                'name'     => 'id_order',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'id_user',
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
                'name'     => 'status',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'address',
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
                            'min'      => 10,
                            'max'      => 2000,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'phone',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'Between',
                        'options' => array(
                            'min'      => 1,
                            'max'      => 999999999999,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'email',
                'required' => false,
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


            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}