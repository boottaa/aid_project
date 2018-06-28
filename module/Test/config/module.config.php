<?php
namespace Test;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'test' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/test[/:action]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'test_models' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/test/models',
                    'defaults' => [
                        'controller' => Controller\ModelsController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],


//    'controllers' => [
//        'factories' => [
//            Controller\IndexController::class => InvokableFactory::class,
//        ],
//    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
