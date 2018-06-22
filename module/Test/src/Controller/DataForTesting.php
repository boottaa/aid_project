<?php
/**
 * Created by PhpStorm.
 * User: b.akhmedov
 * Date: 22.06.18
 * Time: 10:24
 */

namespace Test\Controller;

class DataForTesting
{

    public const HASH = 'k33f3c8db70d437ce41cfbd1bbde0f413';

    /**
     * @param string $class
     * @param string $method
     * @param int $count
     *
     * @return array
     */
    static function data(string $class, string $method, int $count = 0):array
    {
        $result = [];

        $data = [

            //module/Aid/src/JsonRpc/ClassHandlers/Employees.php
            'employees' => [
                'getItem' => [
                    ['id' => @$_SESSION['employees']['add']?:1],

                ],
                'fethList' => [
                    ['page' => 1, 'limit' => 10],
                ],
                'add' => [
                    ['data' => [
                            'fname' => 'TEST_AUT',
                            'lname' => 'TEST_AUT',
                            'email' => 'TEST_AUT@te.ru',
                            'rating' => 50,
                            'password' => 'TEST_AUT',
                            'status' => 1,
                        ]
                    ]
                ],
                'delete' => [
                    ['id' => @$_SESSION['employees']['add']?:1]
                ]
            ],

            //module/Aid/src/JsonRpc/ClassHandlers/Orders.php
            'orders' => [
                'getItem' => [
                    ['id' => @$_SESSION['orders']['add']?:1],

                ],
                'fethList' => [
                    ['page' => 1, 'limit' => 10],
                ],
                'add' => [
                    ['data' =>
                        [
                            'status' => 1,
                            'address' => 'TESTAUT TEST TEST',
                            'phone' => '111111111',
                            'email' => 'TEST_AUT@te.ru',
                        ]
                    ]
                ],
                'delete' => [
                    ['id' => @$_SESSION['orders']['add']?:1]
                ]
            ],

            //module/Aid/src/JsonRpc/ClassHandlers/Professions.php
            'professions' => [
                'addProfession' => [
                    ['data' =>
                        [
                            'title' => 'TEST_PROF',
                        ]
                    ]
                ],

                'addEmployeeProfession' => [
                    ['data' =>
                        [
                            'id_employee' => $_SESSION['employees']['add']?:2,
                            'id_profession' => @$_SESSION['professions']['addProfession']?:2,
                            'price' => 100,
                            'experience' => '2 года',
                            'description' => 'TEST TEST TEST TEST',
                        ]
                    ],
                ],

                'getProfessionToEmployee' => [
                    [ 'data' => ['id_employee' => @$_SESSION['employees']['add']?:2] ],

                ],
            ]

        ];

        if (isset($data[$class][$method][$count]))
            $result = $data[$class][$method][$count];

        return $result;
    }

}