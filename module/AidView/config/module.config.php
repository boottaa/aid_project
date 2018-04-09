<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace AidView;

use Zend\Router\Http\Segment;

$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';

return [
    'router' => [
        'routes' => [
            'aid' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/aidview[/:action]',
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
        ],
    ],

    'view_manager' => [

	    'template_path_stack' => [
		    __DIR__ . '/../view',
	    ],
	    'layout' => 'layout/layout',
    ],
];
