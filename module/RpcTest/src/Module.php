<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace RpcTest;

use Aid\Model\ApiAccess;
use Aid\Model\Order\Orders;
use Aid\Model\Order\OrdersTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;


class Module implements ConfigProviderInterface
{
    const VERSION = '1.0.0';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }


}
