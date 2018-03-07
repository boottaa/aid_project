<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 07.03.18
 * Time: 15:07
 */

namespace Aid\Model\Order;

use Zend\Db\TableGateway\TableGateway;

class OrdersTable
{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}

	public function fetchAll()
	{
		$resultSet = $this->tableGateway->select();
		return $resultSet;
	}

	public function getOrder($id)
	{
		$id  = (int) $id;
		$rowset = $this->tableGateway->select(array('id_order' => $id));
		$row = $rowset->current();
		if (!$row) {
			throw new \Exception("Could not find row $id");
		}
		return $row;
	}

	public function saveOrder(Orders $order)
	{
		$data = array(
			'id_user'      => $order->id_user,
			'id_employee'  => $order->id_employee,
			'status'       => $order->status,
			'address'      => $order->address,
			'phone'        => $order->phone,
			'email'        => $order->email,
			'date_create'  => $order->date_create,
		);

		$id = (int) $order->id_order;
		if ($id == 0) {
			$this->tableGateway->insert($data);
		} else {
			if ($this->getOrder($id)) {
				$this->tableGateway->update($data, array('id' => $id));
			} else {
				throw new \Exception('Album id does not exist');
			}
		}
	}

	public function deleteAlbum($id)
	{
		$this->tableGateway->delete(array('id_order' => (int) $id));
	}
}