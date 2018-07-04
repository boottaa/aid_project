<?php
namespace Test;

use Aid\Model\ApiAccess;
use Aid\Model\Employee\EmployeesTable;
use Aid\Model\EmployeeProfession\EmployeeProfessionsTable;
use Aid\Model\Order\Orders;
use Aid\Model\Order\OrdersTable;
use Aid\Model\Pofession\ProfessionsTable;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ServiceManager\ConfigInterface;
use Zend\ServiceManager\Factory\InvokableFactory;

class Module implements ConfigProviderInterface
{
    const VERSION = '3.0.3-dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }


    public function getServiceConfig()
    {
        return (new \Aid\Module())->getServiceConfig();
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\ModelsController::class => function($sm)
                {
                    return new Controller\ModelsController([
                        ApiAccess::class => $sm->get(ApiAccess::class),
                        EmployeesTable::class => $sm->get(EmployeesTable::class),
                        ProfessionsTable::class => $sm->get(ProfessionsTable::class),
                        EmployeeProfessionsTable::class => $sm->get(EmployeeProfessionsTable::class),
                        Orders::class => $sm->get(Orders::class)
                    ]);
                },
                Controller\IndexController::class => InvokableFactory::class
            ]
        ];
    }
}
