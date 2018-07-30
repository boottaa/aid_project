<?php
/**
 * Created by PhpStorm.
 * User: b.akhmedov
 * Date: 04.07.18
 * Time: 13:13
 */

namespace Aid\Interfaces\Models;

use Zend\Db\Adapter\AdapterInterface;

interface Construct
{
    /**
     * Construct constructor.
     *
     * @param AdapterInterface $tableGateway
     *
     * @return void
     */
    public function __construct(AdapterInterface $tableGateway);
}