<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Aid;

use Aid\Controller\Plugin\Load;

use Aid\JsonRpc\ClassHandlers\InitBase;
use Aid\Model\ApiAccess;
use Aid\Model\Employees;
use Aid\Model\Orders;
use Aid\Model\Professions;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Sql\Sql;
use Zend\Db\TableGateway\TableGateway;
use Zend\Json\Server\Error;
use Zend\Json\Server\Response;
use Zend\Log\Logger;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ServiceManager\Exception;
use Zend\ServiceManager\ServiceManager;

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

                InitBase::class => function($sm) {
                    return new InitBase();
                },
                'orders' =>  function($sm) {
                    /**
                     * @global $sm ServiceManager
                     */
                    $model = new Orders($sm->get(AdapterInterface::class));
                    return $sm->get(InitBase::class)->init($model);
				},

//                'professions' =>  function($sm) {
//                    /**
//                     * @var $sm ServiceManager
//                     */
//                    $dbAdapter = $sm->get(AdapterInterface::class);
//                    return (new \Aid\JsonRpc\ClassHandlers\InitBase())->init(Orders::class, $dbAdapter);
//                },


                ApiAccess::class => function($sm) {
                    /**
                     * @var $sm ServiceManager
                     */
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

