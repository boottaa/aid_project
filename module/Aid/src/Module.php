<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Aid;

use Aid\JsonRpc\ServerFactory;
use Aid\Model\ApiAccess;
use Aid\Model\Orders;
use Aid\Model\Professions;
use Aid\Model\Users;
use Aid\Model\UsersAddress;
use Aid\Model\UsersProfession;
use Aid\Helpers\Auth\AuthFactory;
use Zend\Cache\Service\StorageCacheAbstractServiceFactory;
use Zend\Cache\Service\StorageCacheFactory;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Log\Logger;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Router\Http\Literal;
use Zend\ServiceManager\Exception;
use Zend\ServiceManager\ServiceManager;

class Module implements ConfigProviderInterface
{
    const VERSION = '1.0.0';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    //Для расширения или изменения в поведение cконфигурируем тут, не нужно костылять в самих обработчиках.
	public function getServiceConfig()
	{
		return array(
			'factories' => [
			    //Need for auth
			    'ModelUsers' => function($sm){
                    return new Users($sm->get(AdapterInterface::class), $sm->get(Logger::class));
                },
                //Кеширование
                StorageCacheFactory::class => StorageCacheFactory::class,
                //Проверка доступа
                ApiAccess::class => AuthFactory::class,
                //Модели
                Orders::class => ServerFactory::class,
                Users::class => ServerFactory::class,
                Professions::class => ServerFactory::class,
                UsersAddress::class => ServerFactory::class,
                UsersProfession::class => ServerFactory::class,
			],
            //alias rout to model
            'aliases' => [
                'orders' => Orders::class,
//                'users' => Users::class,
                'professions' => Professions::class,
                'users_address' => UsersAddress::class,
                'users_profession' => UsersProfession::class,
            ],
		);
	}

	public function getControllerConfig()
	{
		return [
			'factories' => [
				Controller\IndexController::class => function ($container) {
                    /**
                     * @var $container ServiceManager
                     * @var $router Literal
                     */
					$router = $container->get('router');
					$request = $container->get('request');
					$routerMatch = $router->match($request);
					$rout = $routerMatch->getParam('model');

                    if ($container->has($rout)) {
                        $jsonRpcServer = $container->get($rout);
                    } else {
                        throw new Exception\InvalidServiceException(sprintf(
                            'Rout writer by name %s not found',
                            $rout
                        ));
                    }

		            return new Controller\IndexController(
                        $container->get(Logger::class),
					    $container->get(ApiAccess::class),
                        $jsonRpcServer,
                        $container->get(StorageCacheFactory::class),
                        ($container->get('config'))['isDebug']
					);
				},

                Controller\AuthController::class => function ($container) {
                    /**
                     * @var $container ServiceManager
                     */
                    $jsonRpcServer = $container->get(Users::class);

                    return new Controller\AuthController(
                        $container->get(Logger::class),
                        $container->get(ApiAccess::class),
                        $jsonRpcServer,
                        $container->get(StorageCacheFactory::class),
                        $container->get('ModelUsers'),
                        ($container->get('config'))['isDebug']
                    );
                },
			]
		];
	}


}

