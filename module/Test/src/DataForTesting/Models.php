<?php
/**
 * Created by PhpStorm.
 * User: b.akhmedov
 * Date: 28.06.18
 * Time: 11:07
 */

namespace Test\DataForTesting;

use Aid\Model\ApiAccess;

use Aid\Model\EmployeeProfessions;
use Aid\Model\Employees;

use Aid\Model\Orders;
use Aid\Model\Professions;

class Models
{

    /**
     * HASH for testing web API
     */
    public const HASH = 'k33f3c8db70d437ce41cfbd1bbde0f413';

    public static function getData($class, $method, $count = 0)
    {
        $result = [];
        $data = [
            ApiAccess::class => [
                'checkAccess' => [
                    str_split(self::HASH)
                ]
            ],
            Employees::class => [
                'getOnly' => [
                    [
                        'id' => @$_SESSION[Employees::class]['id']?:6
                    ]
                ],
                'save' => [
                    [
                            'fname' => 'TEST_MODEL',
                            'lname' => 'x2x',
                            'email' => 'aaa@fs.ru',
                            'rating' => '50',
                            'password' => 'test',
                            'status' => 1
                    ]
                ],
                'delete' => [
                    'id' => @$_SESSION[$class]['id']?:1,
                ]
            ],
            Professions::class => [
                'getOnly' => [
                    [
                        'id' => @$_SESSION[$class]['id']?:6
                    ]
                ],
                'save' => [
                    [
                        'title' => 'TEST_MODEL',
                    ],
                ],
                'deleteProfession' => [
                    @$_SESSION[$class]['id']
                ],
            ],
            EmployeeProfessions::class => [
                'saveEmployeeProfession' => [
                    [
                        'id_employee' => @$_SESSION[Employees::class]['id'] ?? 1,
                        'id_profession' => @$_SESSION[Professions::class]['id'] ?? 1,
                        'price' => '50',
                        'experience' => '2 года',
                        'description' => 'test',
                    ],
                ],

                'getEmployeeProfession' => [
                    [
                        'id_employee' => @$_SESSION[$class]['id'] ?? 1
                    ]
                ],
                'deleteEmployeeProfession' => [
                    [
                        'id_employee' => @$_SESSION[Employees::class]['id'] ?? 1,
                        'id_profession' => @$_SESSION[Professions::class]['id'] ?? 1,
                    ]
                ],
            ],
            Orders::class => [
                'getOnly' => [
                    [
                        'id' => @$_SESSION[$class]['id']?:6
                    ]
                ],
                'save' => [
                    [
                        'id_user' => 1,
                        'id_employee' => @$_SESSION[Employees::class]['id'] ?: 1,
                        'status' => 1,
                        'address' => 'test test test test test testtesttest',
                        'phone' => 777777,
                        'email' => 'test@te.ru'
                    ],
                ],
                'delete' => [
                    'id' => @$_SESSION[$class]['id']?:1
                ],
            ]
        ];

        if(isset($data[$class][$method][$count]))
            $result = $data[$class][$method][$count];

        return $result;
    }
}