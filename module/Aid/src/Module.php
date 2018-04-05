<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Aid;

use Aid\Controller\Plugin\Load;
use Aid\Controller\Plugin\Service\PluginLoggerFactory;
use Aid\Model\ApiAccess;
use Aid\Model\Employee\Employees;
use Aid\Model\Employee\EmployeesTable;
use Aid\Model\Order\Orders;
use Aid\Model\Order\OrdersTable;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\TableGateway\TableGateway;
use Zend\Json\Server\Error;
use Zend\Json\Server\Response;
use Zend\Json\Server\Server;
use Zend\Log\Logger;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ServiceManager\Exception;

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

				OrdersTable::class =>  function($sm) {
					$dbAdapter = $sm->get(AdapterInterface::class);
					$resultSetPrototype = new ResultSet();
					$resultSetPrototype->setArrayObjectPrototype(new Orders());
					$tableGateway = new TableGateway('orders', $dbAdapter, null, $resultSetPrototype);
					$table = new OrdersTable($tableGateway);
					return $table;
				},

				EmployeesTable::class =>  function($sm) {
	                $dbAdapter = $sm->get(AdapterInterface::class);
	                $resultSetPrototype = new ResultSet();
	                $resultSetPrototype->setArrayObjectPrototype(new Employees());
	                $tableGateway = new TableGateway('employee', $dbAdapter, null, $resultSetPrototype);
                    $table = new EmployeesTable($tableGateway);
                    return $table;
                },

				'orders' => function($sm){
					$class = new \Aid\JsonRpc\ClassHandlers\Orders($sm->get(OrdersTable::class), new Orders());
					$server = new \Aid\JsonRpc\Server();
					$server->setClass($class);
					return $server;
				},
                'employees' => function($sm){
                    $class = new \Aid\JsonRpc\ClassHandlers\Employees($sm->get(EmployeesTable::class), new Employees());
                    $server = new \Aid\JsonRpc\Server();
                    $server->setClass($class);
                    return $server;
                },

                ApiAccess::class => function($sm) {
                    $dbAdapter = $sm->get(AdapterInterface::class);
                    $sql = new Sql($dbAdapter, 'api_access');
                    return new ApiAccess($sql);
                },

			),
		);
	}

	public function getControllerPluginConfig()
    {
        return [
            'factories' => [
                'Load' => function(){
                    return new Load([
                        Error::class => Error::class,
                        Response::class => Response::class,
                    ]);
                },
            ]
        ];
    }

	public function getControllerConfig()
	{
		return [
			'factories' => [
				Controller\IndexController::class => function ($container) {

					$router = $container->get('router');
					$request = $container->get('request');
					$routerMatch = $router->match($request);
					$rout = $routerMatch->getParam("action");

					if (! $container->has($rout)) {
						throw new Exception\InvalidServiceException(sprintf(
							'Rout writer by name %s not found',
							$rout
						));
					}

		            return new Controller\IndexController(
                        $container->get(Logger::class),
					    $container->get(ApiAccess::class),
						$container->get($rout)
					);
				}
			]
		];
	}


}

