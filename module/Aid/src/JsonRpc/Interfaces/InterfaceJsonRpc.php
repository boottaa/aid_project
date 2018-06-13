<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 04.04.18
 * Time: 9:43
 */

namespace Aid\JsonRpc\Interfaces;

interface InterfaceJsonRpc
{
	public function getItem(int $id);
	public function fethList(int $page, int $limit);
	public function add(array $data);
	public function delete(int $id);
    public function getJsonRpcServer();
}