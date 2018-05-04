<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Aid;

use Zend\Router\Http\Segment;

$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';

return [
    'router' => [
        'routes' => [
            'aid' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/aid[/:hash][/:action][/:id]',
                    'constraints' => [
                        'hash' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
	                    'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
//Для тестирование модели
            'taid' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/taid[/:action][/:id]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\TestController::class,
                        'action'     => 'index',
                    ],
                ],
            ]
        ],
    ],

    'view_manager' => [
	    'template_path_stack' => [
		    __DIR__ . '/../view',
	    ],
	    'layout' => 'api/json',
    ],
];
