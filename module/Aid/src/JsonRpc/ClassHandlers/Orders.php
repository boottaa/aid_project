<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 07.03.18
 * Time: 13:04
 */

namespace Aid\JsonRpc\ClassHandlers;

use Aid\JsonRpc\Interfaces\getJsonRpcClass;
use Aid\JsonRpc\Interfaces\InterfaceJsonRpc;
use Aid\Model\Order\OrdersTable;
use Aid\Model\Order\Orders as dOrders;
use Zend\Json\Server\Exception\ErrorException;

class Orders implements InterfaceJsonRpc, getJsonRpcClass
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
		try{
			return $this->ordersTable->getOrder($id);
		}catch (\Exception $e){
			throw new ErrorException("Error: not found order with id: ".$id);
		}
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
            return $this->ordersTable->saveOrder($order);

        }else{
            throw new ErrorException("Error: not valid data. Messages: ".  json_encode($filter->getMessages()));//"Error: not valid data";
        }
    }

    public function delete(int $id)
    {
        return $this->ordersTable->deleteOrder($id);
    }

    public function getJsonRpcServer(){
        $server = new \Aid\JsonRpc\Server();
        $server->setClass($this);
        return $server;
    }
}