<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 07.03.18
 * Time: 15:00
 */
namespace Aid\Model\Order;

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

	public function exchangeArray($data)
	{
		$this->id_order     = (!empty($data['id_order'])) ? $data['id_order'] : null;
		$this->id_user      = (!empty($data['id_user'])) ? $data['id_user'] : null;
		$this->id_employee  = (!empty($data['id_employee'])) ? $data['id_employee'] : null;
		$this->status       = (!empty($data['status'])) ? $data['status'] : '0';
		$this->address      = (!empty($data['address'])) ? $data['address'] : null;
		$this->phone        = (!empty($data['phone'])) ? $data['phone'] : null;
		$this->email        = (!empty($data['email'])) ? $data['email'] : null;
		$this->date_create  = (!empty($data['date_create'])) ? $data['date_create'] : null;
		$this->is_deleted   = (!empty($data['is_deleted'])) ? $data['is_deleted'] : null;
	}
}