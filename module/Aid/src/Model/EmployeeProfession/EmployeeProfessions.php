<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 05.04.18
 * Time: 16:26
 */
namespace Aid\Model\EmployeeProfession;

class EmployeeProfessions
{
	public $id_employee;
	public $id_profession;
	public $date_create;
	public $is_deleted;


	public function exchangeArray($data)
	{
		$this->id_employee    = (!empty($data['id_employee'])) ? $data['id_employee'] : null;
		$this->id_profession  = (!empty($data['id_profession'])) ? $data['id_profession'] : null;
		$this->date_create    = (!empty($data['date_create'])) ? $data['date_create'] : null;
		$this->is_deleted     = (!empty($data['is_deleted'])) ? $data['is_deleted'] : '0';
	}
}