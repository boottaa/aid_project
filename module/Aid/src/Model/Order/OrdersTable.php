<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 07.03.18
 * Time: 15:07
 */

namespace Aid\Model\Order;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class OrdersTable
{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}

//	public function fetchAll()
//	{
//		$resultSet = $this->tableGateway->select();
//
//		return $resultSet;
//	}

    public function fetchAll($paginated=false, $satus = 1)
    {
        if ($paginated) {

            $select = new Select('orders');
            $select->where([
                'is_deleted' => '0',
                'status' => $satus
            ]);

            $resultSetPrototype = new ResultSet();
            $resultSetPrototype->setArrayObjectPrototype(new Orders());
            $paginatorAdapter = new DbSelect(
                $select,
                $this->tableGateway->getAdapter(),
                $resultSetPrototype
            );
            $paginator = new Paginator($paginatorAdapter);
            return $paginator;
        }
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

	public function getOrder($id, $satus = 1)
	{
		$id  = (int) $id;
		$rowset = $this->tableGateway->select([
		    'id_order' => $id,
            'is_deleted' => '0',
            'status' => $satus
        ]);

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
				$this->tableGateway->update($data, array('id_order' => $id));
			} else {
				throw new \Exception('id_order does not exist');
			}
		}
		if(!empty($id)){
		    return $id;
        }else{
		    return $this->tableGateway->getLastInsertValue();
        }

	}

	public function deleteOrder(int $id)
	{
        return $this->tableGateway->update([
		    'status' => 0,
            'is_deleted' => '1'
        ], ['id_order' => (int) $id]);
	}
}