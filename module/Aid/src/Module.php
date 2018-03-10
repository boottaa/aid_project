<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Aid;

use Aid\Model\ApiAccess;
use Aid\Model\Employee\Employees;
use Aid\Model\Employee\EmployeesTable;
use Aid\Model\Order\Orders;
use Aid\Model\Order\OrdersTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\TableGateway\TableGateway;
use Zend\Json\Server\Server;
use Zend\ModuleManager\Feature\ConfigProviderInterface;


class Module implements ConfigProviderInterface
{
    const VERSION = '1.0.0';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

	public function getServiceConfig()
	{

		return array(
			'factories' => array(
				'Aid\Model\Order\OrdersTable' =>  function($sm) {
					$tableGateway = $sm->get('OrdersTableGateway');
					$table = new OrdersTable($tableGateway);
					return $table;
				},
				'OrdersTableGateway' => function ($sm) {
					$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
					$resultSetPrototype = new ResultSet();
					$resultSetPrototype->setArrayObjectPrototype(new Orders());
					return new TableGateway('orders', $dbAdapter, null, $resultSetPrototype);
				},
                'RpcOrder' => function($sm){
                    $class = new \Aid\JsonRpc\Orders($sm->get(OrdersTable::class), new Orders());
                    $server = new Server();
                    $server->setClass($class);
                    return $server;
                },

                'Aid\Model\Employee\EmployeesTable' =>  function($sm) {
                    $tableGateway = $sm->get('EmployeesTableGateway');
                    $table = new EmployeesTable($tableGateway);
                    return $table;
                },
                'EmployeesTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Employees());
                    return new TableGateway('employee', $dbAdapter, null, $resultSetPrototype);
                },
                'RpcEmployee' => function($sm){
                    $class = new \Aid\JsonRpc\Employees($sm->get(EmployeesTable::class), new Employees());
                    $server = new Server();
                    $server->setClass($class);
                    return $server;
                },

                'Aid\Model\ApiAccess' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $sql = new Sql($dbAdapter, 'api_access');
                    return new ApiAccess($sql);
                },


			),
		);
	}

	public function getControllerConfig()
	{
		return [
			'factories' => [
				Controller\IndexController::class => function ($container) {
					return new Controller\IndexController(
					    $container->get(ApiAccess::class),
                        [
                            "RpcOrder" => $container->get("RpcOrder"),
                            "RpcEmployee" => $container->get('RpcEmployee'),
                        ]

					);
				}
			]
		];
	}
}
