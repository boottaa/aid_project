<?php
/**
 * Created by PhpStorm.
 * User: boott
 * Date: 08.03.2018
 * Time: 12:37
 */

namespace Aid\Model;

use Aid\Helpers\Auth\Rights;
use Aid\Interfaces\Models\Auth;
use Aid\Interfaces\Models\Construct;
use Aid\Interfaces\Models\Delete;
use Aid\Interfaces\Models\ExchangeArray;
use Aid\Interfaces\Models\Filter;
use Aid\Interfaces\Models\GetOnly;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Sql\Sql;
use Zend\Db\TableGateway\TableGateway;
use Zend\InputFilter\InputFilter;
use Zend\Log\LoggerInterface;

class ApiAccess implements GetOnly, Filter, Delete, Construct, ExchangeArray, Auth
{

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var TableGateway
     */
    protected $tableGateway;

    /**
     * @var Rights
     */
    protected $acl;
    
    protected $table = 'api_access';

    protected $data = [
        'id' => null,
        'hash' => '',
        'status' => 1,
        'applications' => 'web',
        'date_create' => null,
        'is_deleted' => 0,
    ];

    /**
     * @var InputFilter
     */
    protected $inputFilter;

    /**
     * Construct constructor.
     *
     * @param AdapterInterface $dbAdapter
     *
     * @return void
     */
    public function __construct(AdapterInterface $dbAdapter, LoggerInterface $logger)
    {
        if (empty($this->table)) {
            throw new \Exception("Error: table is empty");
        }
        $this->logger = $logger;

        $this->tableGateway = new TableGateway($this->table, $dbAdapter);
    }

    /**
     * @param Rights $acl
     */
    public function setAcl(Rights $acl)
    {
        $this->acl = $acl;
    }

    /**
     * @param array $where
     *
     * @return int
     */
    public function delete(array $where)
    {
        return $this->tableGateway->update([
            'is_deleted' => '1'
        ], $where);
    }

    /**
     * @param array $data
     *
     * @return self
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

    /**
     * @return mixed
     */
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

    /**
     * @return InputFilter
     */
    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                'name'     => 'id',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ))->add(array(
                'name'     => 'status',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ))->add(array(
                'name'     => 'hash',
                'required' => false,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 32,
                            'max'      => 32,
                        ),
                    ),
                ),
            ))->add(array(
                'name'     => 'applications',
                'required' => false,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 3,
                            'max'      => 32,
                        ),
                    ),
                ),
            ));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

    public function getOnly(array $where)
    {
        $rowset = $this->tableGateway->select($where);

        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Access denied! ");
        }
        return $row;
    }

    /**
     * @param string $hash - Определяем пользователя
     * @param string $class - Есть ли у пользователя доступ к классу
     * @param string $method - Если у пользователя доступ к методу класса
     * @return bool
     */
    public function check(string $user_ip, string $hash, string $class, string $method = null): bool
    {
        try {
            $row = iterator_to_array($this->getOnly(['hash' => $hash, 'status' => '1', 'is_deleted' => '0']));
            if (empty($row)){
                $this->logger->alert("check access error");
                return false;
            }

            $application = $row['applications'];
            $this->logger->info("CHECK_ACCESS - IP: ".$user_ip." HASH: ".$hash." CLASS: ".$class." METHOD: ".$method);

            return $this->acl->isAllowed($application, $class, $method);

        }catch (\Exception $e){
            return false;
        }
    }
}