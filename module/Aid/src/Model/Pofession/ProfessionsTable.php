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

class ProfessionsTable
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
            $select = new Select('profession');
            $select->where([
                'is_deleted' => '0',
            ]);

            $resultSetPrototype = new ResultSet();
            $resultSetPrototype->setArrayObjectPrototype(new Professions());
            $paginatorAdapter = new DbSelect(
                $select,
                $this->tableGateway->getAdapter(),
                $resultSetPrototype
            );
            $paginator = new Paginator($paginatorAdapter);
            //iterator_to_array
            return $paginator;
    }

    public function getProfession(int $id_profession)
    {
        $rowset = $this->tableGateway->select([
            'id_profession' => $id_profession,
            'is_deleted' => '0',
        ]);

        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id_profession");
        }
        return $row;
    }

    public function saveProfession(Professions $professions)
    {
        $data = [
            'id_profession' => $professions->id_profession,
            'date_create'   => $professions->date_create,
            'is_deleted'    => $professions->is_deleted,
            'title'          => $professions->title,
        ];

        $id = (int) $professions->id_profession;
        if (empty($id)) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getProfession($id)) {
                $this->tableGateway->update($data, ['id_profession' => $id]);
            } else {
                throw new \Exception('id_profession does not exist');
            }
        }

        if(!empty($id)){
            return $id;
        }else{
            return $this->tableGateway->getLastInsertValue();
        }


    }

    public function deleteProfession(int $id_profession)
    {
        return $this->tableGateway->update([
            'is_deleted' => '1'
        ], ['id_profession' => $id_profession]);
    }
}