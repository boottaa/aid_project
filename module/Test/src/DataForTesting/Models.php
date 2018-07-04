<?php
/**
 * Created by PhpStorm.
 * User: b.akhmedov
 * Date: 28.06.18
 * Time: 11:07
 */

namespace Test\DataForTesting;

use Aid\Model\ApiAccess;
use Aid\Model\Employee\Employees;
use Aid\Model\Employee\EmployeesTable;
use Aid\Model\EmployeeProfession\EmployeeProfessions;
use Aid\Model\EmployeeProfession\EmployeeProfessionsTable;
use Aid\Model\Order\Orders;
use Aid\Model\Order\OrdersTable;
use Aid\Model\Pofession\Professions;
use Aid\Model\Pofession\ProfessionsTable;

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
            EmployeesTable::class => [
                'getEmployee' => [
                    @$_SESSION[$class]['id']?:6
                ],
                'saveEmployee' => [
                    (new Employees())->exchangeArray([
                        'fname' => 'TEST_MODEL',
                        'lname' => 'x2x',
                        'email' => 'aaa@fs.ru',
                        'rating' => '50',
                        'password' => 'test',
                        'status' => 1
                    ]),
                ],
                'deleteEmployee' => [
                    @$_SESSION[$class]['id'],
                ]
            ],
            ProfessionsTable::class => [
                'getProfession' => [
                    @$_SESSION[$class]['id']?:6
                ],
                'saveProfession' => [
                    (new Professions())->exchangeArray([
                        'title' => 'TEST_MODEL',
                    ]),
                ],
                'deleteProfession' => [
                    @$_SESSION[$class]['id']
                ],
            ],
            EmployeeProfessionsTable::class => [
                'saveEmployeeProfession' => [
                    (new EmployeeProfessions())->exchangeArray([
                        'id_employee' => @$_SESSION[EmployeesTable::class]['id'] ?? 1,
                        'id_profession' => @$_SESSION[ProfessionsTable::class]['id'] ?? 1,
                        'price' => '50',
                        'experience' => '2 года',
                        'description' => 'test',
                    ]),
                ],

                'getEmployeeProfession' => [
                    (new EmployeeProfessions())->exchangeArray([
                        'id_employee' => @$_SESSION[$class]['id'] ?? 1
                    ])
                ],
                'deleteEmployeeProfession' => [
                    (new EmployeeProfessions())->exchangeArray([
                        'id_employee' => @$_SESSION[EmployeesTable::class]['id'] ?? 1,
                        'id_profession' => @$_SESSION[ProfessionsTable::class]['id'] ?? 1,
                    ])
                ],
            ],
            Orders::class => [
                'getOnly' => [
                    'id' => @$_SESSION[$class]['id']?:6
                ],
                'save' => [
                    [
                        'id_user' => 1,
                        'id_employee' => @$_SESSION[EmployeesTable::class]['id'] ?? 1,
                        'status' => 1,
                        'address' => 'test',
                        'phone' => 777777,
                        'email' => 'test@te.ru'
                    ],
                ],
                'delete' => [
                    @$_SESSION[$class]['id']
                ],
            ]
        ];

        if(isset($data[$class][$method][$count]))
            $result = $data[$class][$method][$count];

        return $result;
    }
}