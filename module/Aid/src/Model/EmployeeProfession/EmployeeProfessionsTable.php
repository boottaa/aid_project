<?php

namespace Aid\Model\EmployeeProfession;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class EmployeeProfessionsTable
{
    /**
     * @var TableGateway
     */
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $select = new Select('employee_profession');
        $select->where([
            'is_deleted' => '0'
        ]);

        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new EmployeeProfessions());
        $paginatorAdapter = new DbSelect(
            $select,
            $this->tableGateway->getAdapter(),
            $resultSetPrototype
        );
        $paginator = new Paginator($paginatorAdapter);

        return iterator_to_array($paginator);
    }

    public function getEmployeeProfession(EmployeeProfessions $professions)
    {
        $id_employee = $professions->id_employee;

        $select = new Select('employee_profession');
        $select->where([
            'id_employee' => $id_employee,
            'is_deleted' => '0',
        ]);

        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new EmployeeProfessions());
        $paginatorAdapter = new DbSelect(
            $select,
            $this->tableGateway->getAdapter(),
            $resultSetPrototype
        );
        $paginator = new Paginator($paginatorAdapter);

        return iterator_to_array($paginator);
    }

    private function checkEmployeeProfession(int $id_employee, int $id_profession)
    {
        $rowset = $this->tableGateway->select([
            'id_employee' => $id_employee,
            'id_profession' => $id_profession,
            'is_deleted' => '0',
        ]);

        $row = $rowset->current();

        if (!$row) {
            return false;
        }
        return true;
    }

    public function saveEmployeeProfession(EmployeeProfessions $professions)
    {
        $data = array(
            'id_employee'   => $professions->id_employee,
            'id_profession' => $professions->id_profession,
            'date_create'   => $professions->date_create,
            'is_deleted'    => $professions->is_deleted,
        );

        $id_employee = (int) $professions->id_employee;
        $id_profession = (int) $professions->id_profession;

        if ($this->checkEmployeeProfession($id_employee, $id_profession)) {
            $this->tableGateway->update($data, ['id_employee' => $id_employee, 'id_profession' => $id_profession]);
        } else {
            $this->tableGateway->insert($data);
        }
        return ['id_employee' => $id_employee, 'id_profession' => $id_profession];
    }

    public function deleteEmployeeProfession(EmployeeProfessions $professions)
    {
        $id_employee = (int) $professions->id_employee;
        $id_profession = (int) $professions->id_profession;
        $this->tableGateway->update([
            'is_deleted' => '1'
        ], ['id_employee' => $id_employee, 'id_profession' => $id_profession]);

        return ['id_employee' => $id_employee, 'id_profession' => $id_profession];
    }
}