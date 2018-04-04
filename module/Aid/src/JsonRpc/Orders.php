<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 07.03.18
 * Time: 13:04
 */

namespace Aid\JsonRpc;


use Aid\Model\Order\OrdersTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Json\Json;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;
use Aid\Model\Order\Orders as dOrders;

class Orders implements InterfaceJsonRpc
{
	private
		/**
		 * @var OrdersTable
		 */
        $ordersTable,
		/**
		 * @var dOrders
		 */
        $order;

	public function __construct(OrdersTable $orders, dOrders $order)
	{
		$this->ordersTable = $orders;
		$this->order = $order;
	}

	public function getItem(int $id){
		return $this->ordersTable->getOrder($id);
	}

	public function fethList(int $page, int $limit)
	{
        $r = $this->ordersTable->fetchAll(true);
        $r->setCurrentPageNumber((int) $page);
        // set the number of items per page to 10
        $r->setItemCountPerPage($limit);

        $x = [];
        $x['getPages'] = $r->getPages();

        foreach ($r as $v)
        {
            $x['items'][] = $v;
        }
		return $x;
	}

    public function add(array $data)
    {
        $order = $this->order;

        $filter = $order->getInputFilter();
        $filter->setData($data);

        if($filter->isValid())
        {
            $order->exchangeArray($data);
            $this->ordersTable->saveOrder($order);

            return true;
        }else{
            return "Error: not valid data";
        }
    }

    public function delete(int $id)
    {
        return $this->ordersTable->deleteOrder($id);
    }
}