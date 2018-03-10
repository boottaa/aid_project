<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 07.03.18
 * Time: 15:07
 */

namespace Aid\Model\Employee;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class EmployeesTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll($paginated=false, $satus = 1)
    {
        if ($paginated) {

            $select = new Select('employee');
            $select->where([
                'is_deleted' => '0',
                'status' => $satus
            ]);

            $resultSetPrototype = new ResultSet();
            $resultSetPrototype->setArrayObjectPrototype(new Employees());
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

    public function getEmployee($id, $satus = 1)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select([
            'id_employee' => $id,
            'is_deleted' => '0',
            'status' => $satus
        ]);

        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveEmployee(Employees $order)
    {
        $data = array(
            'id_employee'  => $order->id_employee,
            'fname'        => $order->fname,
            'lname'        => $order->lname,
            'email'        => $order->email,
            'rating'       => $order->rating,
            'password'     => $order->password,
            'status'       => $order->status,
            'date_create'  => $order->date_create,
            'is_deleted'   => $order->is_deleted,
        );

        $id = (int) $order->id_employee;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getEmployee($id)) {
                $this->tableGateway->update($data, array('id_employee' => $id));
            } else {
                throw new \Exception('id_employee does not exist');
            }
        }
    }

    public function deleteEmployee(int $id)
    {
        return $this->tableGateway->update([
            'status' => 0,
            'is_deleted' => '1'
        ], ['id_order' => (int) $id]);
    }
}