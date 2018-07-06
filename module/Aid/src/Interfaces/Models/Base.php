<?php
/**
 * Created by PhpStorm.
 * User: b.akhmedov
 * Date: 04.07.18
 * Time: 13:13
 */

namespace Aid\Interfaces\Models;

use Zend\Db\TableGateway\TableGateway;

interface Base
{
    //Input TableGetway
    public function __construct(TableGateway $tableGateway);

    //Input filter use in method exchangeArray
    public function getInputFilter();

    //Input data
    public function exchangeArray(array $data);

    public function fetchAll($status = 1);

    public function getOnly(array $where);

    public function delete(array $where);

    public function save($d);


}