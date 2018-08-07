<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 07.03.18
 * Time: 13:04
 */

namespace Aid\JsonRpc;

use Aid\Interfaces\Models\All;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\Db\Adapter\AdapterInterface;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class ServerFactory implements FactoryInterface
{
    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     *
     * @return Server
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): Server
    {
        $dataBaseAdapter = $container->get(AdapterInterface::class);
        if (class_exists($requestedName)) {
            $model = new $requestedName($dataBaseAdapter);
            if($model instanceof All){
                $server = new Server();
                $server->setClass(new Base($model));
                return $server;
            }
            throw new \Exception('Class '.$requestedName.' not instanceof to All');
        }else{
            throw new \Exception('Class '.$requestedName.' not fount');
        }
    }

}