<?php
/**
 * Created by PhpStorm.
 * User: b.akhmedov
 * Date: 07.08.18
 * Time: 16:51
 */

namespace Aid\Helpers\Auth;

use Aid\Model\ApiAccess;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\Cache\Service\StorageCacheFactory;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Log\Logger;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class AuthFactory implements FactoryInterface
{

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     *
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $logger = $container->get(Logger::class);
        $cache = $container->get(StorageCacheFactory::class);
        $dbAdapter = $container->get(AdapterInterface::class);
        $isDebug = ($container->get('config'))['isDebug'];
        $acl = new Rights($cache);
        $apiAccess = new ApiAccess($dbAdapter, $logger, $isDebug);
        $apiAccess->setAcl($acl);

        return $apiAccess;
    }
}