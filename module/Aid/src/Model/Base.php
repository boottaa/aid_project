<?php
/**
 * Created by PhpStorm.
 * User: b.akhmedov
 * Date: 02.07.18
 * Time: 14:13
 */

namespace Aid\Model;

use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;
use Zend\InputFilter\InputFilter;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;
use Aid\Interfaces\Models;
use Zend\Db\Adapter\AdapterInterface;

abstract class Base implements Models\All
{
    /**
     * @var TableGateway
     */
    protected $tableGateway;
    protected $table = '';

    protected $data = [];
    /**
     * @var InputFilter
     */
    protected $inputFilter;

    public function __construct(AdapterInterface $dbAdapter)
    {
        if (empty($this->table)) {
            throw new \Exception("Error: table is empty");
        }

        $this->tableGateway = new TableGateway($this->table, $dbAdapter);
    }

    /**
     * @param array $data
     *
     * @return $this
     * @throws \Exception
     */
    public function exchangeArray(array $data)
    {
        /**
         * @var $inputFilter InputFilter
         */
        $inputFilter = $this->getInputFilter();

        $inputFilter->setData($data);

        if($inputFilter->isValid()){
            $this->data = $data;
        }else{
            throw new \Exception("ERRORS: ".json_encode($inputFilter->getMessages()));
        }

        return $this;
    }

    public function fetchAll(int $satus = 1): Paginator
    {
        $select = new Select($this->table);
        $select->where([
            'is_deleted' => '0',
            'status' => $satus
        ]);

        $paginatorAdapter = new DbSelect(
            $select,
            $this->tableGateway->getAdapter()
        );
        $paginator = new Paginator($paginatorAdapter);

        return $paginator;
    }

    public function getOnly(array $where)
    {
        $rowset = $this->tableGateway->select($where);

        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row ".implode(', ', $where));
        }
        return $row;
    }

    public function save()
    {
        $id = 0;

        $data = $this->data;

        if(isset($data['id'])){
            $id = (int) $data['id'];
        }
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getOnly(['id' => $id])) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('id does not exist');
            }
        }
        if(!empty($id)){
            return $id;
        }else{
            return $this->tableGateway->getLastInsertValue();
        }

    }

    public function delete(array $where)
    {
        return $this->tableGateway->update([
            'is_deleted' => '1'
        ], $where);
    }

    abstract function getInputFilter();
}