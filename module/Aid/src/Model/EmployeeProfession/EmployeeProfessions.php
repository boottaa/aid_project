<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 05.04.18
 * Time: 16:26
 */
namespace Aid\Model\EmployeeProfession;

use Zend\InputFilter\InputFilter;

class EmployeeProfessions
{
	public $id_employee;
	public $id_profession;
	public $date_create;
	public $is_deleted;
	public $price;
	public $experience;
	public $description;

    protected $inputFilter;

	public function exchangeArray($data)
	{
		$this->id_employee    = (!empty($data['id_employee'])) ? $data['id_employee'] : null;
		$this->id_profession  = (!empty($data['id_profession'])) ? $data['id_profession'] : null;
		$this->date_create    = (!empty($data['date_create'])) ? $data['date_create'] : null;
		$this->is_deleted     = (!empty($data['is_deleted'])) ? $data['is_deleted'] : '0';
		$this->price          = (!empty($data['price'])) ? $data['price'] : '0';
		$this->experience     = (!empty($data['experience'])) ? $data['experience'] : '';
		$this->description    = (!empty($data['description'])) ? $data['description'] : '';
	}

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
                'required' => true,
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