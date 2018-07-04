<?php
/**
 * Created by PhpStorm.
 * User: b.akhmedov
 * Date: 02.07.18
 * Time: 14:13
 */

namespace Aid\Model;

use Aid\Model\Order\Orders;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;
use Zend\InputFilter\InputFilter;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;
use Aid\Interfaces\Models;

abstract class Base implements Models\Base
{
    /**
     * @var TableGateway
     */
    protected $tableGateway;

    private $table = '';

    protected $data = [];
    /**
     * @var InputFilter
     */
    protected $inputFilter;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
        $this->table = $tableGateway->getTable();
    }

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
            new \Exception("ERRORS: ".json_encode($inputFilter->getMessages()));
        }

        //FOR TESTING
        return $this;
    }

    public function fetchAll($satus = 1)
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

    public function save($l)
    {
        $data = $this->data;
        $id = (int) $data['id'];

        if ($id == 0) {
            $l->notice("AAAAA");
            $this->tableGateway->insert($data);
        } else {
            $l->notice("xSSSS");
            if ($this->getOnly(['id' => $id])) {
                $l->notice("asddd");
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                $l->notice("dassss");
                throw new \Exception('id does not exist');
            }
        }
        if(!empty($id)){
            $l->notice("errr");
            return $id;
        }else{
            $l->notice("ddddd".$this->tableGateway->getLastInsertValue());
            return $this->tableGateway->getLastInsertValue();
        }

    }

    public function delete(int $id)
    {
        return $this->tableGateway->update([
            'status' => 0,
            'is_deleted' => '1'
        ], ['id' => (int) $id]);
    }

    abstract function getInputFilter();
}