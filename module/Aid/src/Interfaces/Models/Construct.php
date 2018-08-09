<?php
/**
 * Created by PhpStorm.
 * User: b.akhmedov
 * Date: 04.07.18
 * Time: 13:13
 */

namespace Aid\Interfaces\Models;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Log\LoggerInterface;

interface Construct
{
    /**
     * Construct constructor.
     *
     * @param AdapterInterface $dbAdapter
     *
     * @return void
     */
    public function __construct(AdapterInterface $dbAdapter, LoggerInterface $logger);
}