<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Aid\Controller\Plugin\Service;

use Aid\Controller\Plugin\PluginLogger;
use Interop\Container\ContainerInterface;
use Zend\Log\Logger;
use Zend\Log\Writer\Stream;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Factory\FactoryInterface;

class PluginLoggerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return PluginLogger
     * @throws ServiceNotCreatedException if Controllermanager service is not found in application service locator
     */
    public function __invoke(ContainerInterface $container, $name, array $options = null)
    {
        if (! $container->has('ControllerManager')) {
            throw new ServiceNotCreatedException(sprintf(
                '%s requires that the application service manager contains a "%s" service; none found',
                __CLASS__,
                'ControllerManager'
            ));
        }
        $writer = new Stream('./logs/Aid/rpcserver.log');
        $logger = new Logger();
        $logger->addWriter($writer);


        return new PluginLogger($logger);
    }
}
