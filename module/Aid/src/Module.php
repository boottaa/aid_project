<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Aid;

use Aid\Model\Order\Orders;
use Aid\Model\Order\OrdersTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
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


			),
		);
	}

	public function getControllerConfig()
	{
		return [
			'factories' => [
				Controller\IndexController::class => function ($container) {
					return new Controller\IndexController(
						$container->get(OrdersTable::class)
					);
				}
			]
		];
	}

//	public function getControllerPluginConfig()
//	{
//		return [
//			'factories' => [
//				'Aid\JsonRpc\Orders' => function ($container) {
//					return new \Aid\JsonRpc\Orders(
//						$container->get(OrdersTable::class)
//					);
//				}
//			]
//		];
//	}
}
