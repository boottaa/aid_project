<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 07.03.18
 * Time: 13:04
 */

namespace Aid\JsonRpc;


use Aid\Model\Order\OrdersTable;

class Orders
{
	private $ordersTable;

	public function __construct(OrdersTable $orders)
	{
		$this->ordersTable = $orders;
	}

	public function getOrder(int $id){
		return $this->ordersTable->getOrder($id);
	}

	/**
	 * Return sum of two variables
	 *
	 * @param  int $x
	 * @param  int $y
	 * @return int
	 */
	public function add($x, $y)
	{
		return $x + $y;
	}

	/**
	 * Return difference of two variables
	 *
	 * @param  int $x
	 * @param  int $y
	 * @return int
	 */
	public function subtract($x, $y)
	{
		return $x - $y;
	}

	/**
	 * Return product of two variables
	 *
	 * @param  int $x
	 * @param  int $y
	 * @return int
	 */
	public function multiply($x, $y)
	{
		return $x * $y;
	}

	/**
	 * Return the division of two variables
	 *
	 * @param  int $x
	 * @param  int $y
	 * @return float
	 */
	public function divide($x, $y)
	{
		return $x / $y;
	}

}