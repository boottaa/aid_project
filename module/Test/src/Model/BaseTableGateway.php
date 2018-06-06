<?php
namespace Test\Model;

use Test\Model\_Interface\BaseTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class BaseTableGateway implements BaseTable
{
    /**
     * @var TableGateway
     */
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function all(array $where = ['is_deleted' => '0'])
    {
        $tableGateway = $this->tableGateway;
        $select = new Select($tableGateway->getTable());
        $select->where($where);

        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new Professions());
        $paginatorAdapter = new DbSelect(
            $select,
            $tableGateway->getAdapter(),
            $resultSetPrototype
        );
        $paginator = new Paginator($paginatorAdapter);

        return iterator_to_array($paginator);
    }

    public function item(array $where = null)
    {
        $rowset = $this->tableGateway->select($where);

        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row (".implode(', ', $where).")");
        }
        return $row;
    }

    public function save(array $data)
    {
        $id_profession = (int) $data['id'];
        if (empty($id_profession)) {
            $this->tableGateway->insert($data);
            return $this->tableGateway->getLastInsertValue();
        } else {
            if ($this->getItem( [ 'id' => $data['id'] ] )) {
                $this->tableGateway->update($data, [ 'id' => $data['id'] ]);
                return ['id' => $id_profession];
            } else {
                throw new \Exception('id_profession does not exist');
            }
        }

    }

    public function delete(int $id)
    {
        return $this->tableGateway->update([
            'is_deleted' => '1'
        ], ['id' => $id]);
    }


}