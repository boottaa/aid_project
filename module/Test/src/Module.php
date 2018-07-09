<?php
namespace Test;

use Aid\Model\ApiAccess;
use Aid\Model\Employees;
use Aid\Model\Orders;
use Aid\Model\EmployeeProfessions;
use Aid\Model\Professions;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
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
                        Employees::class => $sm->get(Employees::class),
                        Professions::class => $sm->get(Professions::class),
//                        EmployeeProfessions::class => $sm->get(EmployeeProfessions::class),
                        Orders::class => $sm->get(Orders::class)
                    ]);
                },
                Controller\IndexController::class => InvokableFactory::class
            ]
        ];
    }
}
