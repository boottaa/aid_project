<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Aid;

use Aid\Controller\Plugin\Load;

use Aid\Model\ApiAccess;
use Aid\Model\Employee\Employees;
use Aid\Model\Employee\EmployeesTable;
use Aid\Model\EmployeeProfession\EmployeeProfessions;
use Aid\Model\EmployeeProfession\EmployeeProfessionsTable;
use Aid\Model\Order\Orders;
use Aid\Model\Order\OrdersTable;
use Aid\Model\Pofession\Professions;
use Aid\Model\Pofession\ProfessionsTable;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\TableGateway\TableGateway;
use Zend\Json\Server\Error;
use Zend\Json\Server\Response;
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

    private function includeTable($sm, $tableName, $descTable, $classTable)
    {
        $dbAdapter = $sm->get(AdapterInterface::class);
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype($descTable);
        $tableGateway = new TableGateway($tableName, $dbAdapter, null, $resultSetPrototype);
        $table = new $classTable($tableGateway);
        return $table;
    }

	public function getServiceConfig()
	{

		return array(
			'factories' => array(

				OrdersTable::class =>  function($sm) {
                    return $this->includeTable($sm, 'orders', new Orders(), OrdersTable::class);
				},

				EmployeesTable::class =>  function($sm) {
                    return $this->includeTable($sm, 'employee', new Employees(), EmployeesTable::class);
                },

                ProfessionsTable::class =>  function($sm) {
                    return $this->includeTable($sm, 'profession', new Professions(), ProfessionsTable::class);
                },
                EmployeeProfessionsTable::class =>  function($sm) {
                    return $this->includeTable($sm, 'employee_profession', new EmployeeProfessions(), EmployeeProfessionsTable::class);
                },

				'orders' => function($sm){
                    return (new \Aid\JsonRpc\ClassHandlers\Orders($sm->get(OrdersTable::class), new Orders()))
                        ->getJsonRpcServer();
				},
                'employees' => function ($sm) {
                    return (new \Aid\JsonRpc\ClassHandlers\Employees($sm->get(EmployeesTable::class), new Employees()))
                        ->getJsonRpcServer();
                },
                'professions' => function($sm){
                    return (new \Aid\JsonRpc\ClassHandlers\Profession(
                        $sm->get(ProfessionsTable::class),
                        new Professions(),
                        $sm->get(EmployeeProfessionsTable::class),
                        new EmployeeProfessions()
                    ))->getJsonRpcServer();
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
				},
                Controller\TestController::class => function ($container) {
		            return new Controller\TestController(
		                [
		                    'p' => $container->get(ProfessionsTable::class),
                            'ep' => $container->get(EmployeeProfessionsTable::class),
                        ]
                    );
                }
			]
		];
	}


}

