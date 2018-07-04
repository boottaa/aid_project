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
use Zend\Log\Logger;

class Orders implements InterfaceJsonRpc, getJsonRpcClass
{
    /**
     * @var OrdersTable
     */
	private $ordersTable;

    /**
     * @var Logger
     */
	private $logger;

	public function __construct(\Aid\Model\Order\Orders $orders, Logger $logger)
	{
		$this->ordersTable = $orders;
		$this->logger = $logger;
//		$this->order = $order;
	}

	public function getItem(int $id){
		try{
			return $this->ordersTable->getOnly(['id' => $id]);
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
        $ex = $this->ordersTable->exchangeArray($data);

        if($ex->getInputFilter()->isValid())
        {
            $r = $ex->save($this->logger);
            $this->logger->err("MMMEESS ".$r);
            return "44";

        }else{
            $this->logger->err("not valid data. Messages: ".  json_encode($ex->getInputFilter()->getMessages()));
            throw new ErrorException("Error: not valid data. Messages: ".  json_encode($ex->getInputFilter()->getMessages()));//"Error: not valid data";
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