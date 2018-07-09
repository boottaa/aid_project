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
use Zend\Json\Server\Exception\ErrorException;

class Employees implements InterfaceJsonRpc, getJsonRpcClass
{
    private
        $employeesTable,
        $employee;

    public function __construct(\Aid\Model\Employees $employees)
    {
        $this->employeesTable = $employees;
        $this->employee = $employees;
    }

    public function getItem(int $id){
	    try{
		    return $this->employeesTable->getEmployee($id);
	    }catch (\Exception $e){
		    throw new ErrorException("Error: not found employee with id: ".$id);
	    }
    }

    public function fethList(int $page, int $limit)
    {
        $r = $this->employeesTable->fetchAll(true);
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
        $employee = $this->employee;

        $filter = $employee->getInputFilter();
        $filter->setData($data);

        if($filter->isValid())
        {
            $employee->exchangeArray($data);
            return $this->employeesTable->saveEmployee($employee);;

        }else{
	        throw new ErrorException("Error: not valid data");//"Error: not valid data";
        }
    }

    public function delete(int $id)
    {
        return $this->employeesTable->deleteEmployee($id);
    }

    public function getJsonRpcServer(){
        $server = new \Aid\JsonRpc\Server();
        $server->setClass($this);
        return $server;
    }
}