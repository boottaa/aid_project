<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 07.03.18
 * Time: 15:07
 */

namespace Aid\Model\Pofession;


use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class PofessionsModel
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll($paginated=false, int $id_employee)
    {
        if ($paginated) {
            $select = new Select('employee_profession');

            $select->where([
                'is_deleted' => '0',
                'id_employee' => $id_employee
            ]);

            $resultSetPrototype = new ResultSet();
            $resultSetPrototype->setArrayObjectPrototype(new Pofessions());
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

    public function getProfessionToEmployee(int $id)
    {
        $rowset = $this->tableGateway->select([
            'id_employee' => $id,
            'is_deleted' => '0',
        ]);

        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function addProfession(Pofessions $pofessions)
    {
        $data = array(
            'id_profession'  => $pofessions->id_profession,
            'title'        => $pofessions->title,
        );

        $id = (int) $pofessions->id_profession;
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