<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 07.03.18
 * Time: 13:04
 */

namespace Aid\JsonRpc\ClassHandlers;

use Aid\JsonRpc\Interfaces\InterfaceJsonRpc;
use Aid\Model\Employee\Employees as dEmployees;
use Aid\Model\Employee\EmployeesTable;
use Zend\Json\Server\Exception\ErrorException;

class Profession
{
    //Получаем все професии по id_employee_id
    public function getList(int $id, int $page, int $limit)
    {
        // TODO: Implement fethList() method.
    }

    //Добавляем професию для id_employee
    public function addProfessionForEmployee(int $id, array $data)
    {
        // TODO: Implement add() method.
    }

    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }
}