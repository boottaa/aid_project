<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 04.04.18
 * Time: 9:43
 */

namespace Aid\Interfaces\JsonRpc;

interface InterfaceJsonRpc
{
	public function getItem(array $where);
	public function fethList(int $page, int $limit);
	public function add(array $data);
	public function delete(array $where);
}