<?php
/**
 * Created by PhpStorm.
 * User: b.akhmedov
 * Date: 22.06.18
 * Time: 10:24
 */

namespace Test\DataForTesting;

class ClassHandlers
{

    /**
     * HASH for testing web API
     *
     * 33f3c8db70d437ce41cfbd1bbde0f413
     */
    const HASH = 'k33f3c8db70d437ce41cfbd1bbde0f413';

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
            //module/Aid/src/JsonRpc/ClassHandlers/Orders.php
            'orders' => [
                'getItem' => [
                    ['where' => ['id' => @$_SESSION['orders']['add']?:1]]
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
                   ['where' => ['id' => @$_SESSION['orders']['add']?:1]]
                ]
            ],

            'users' => [
                'getItem' => [
                    ['where' => ['id' => @$_SESSION['users']['add']?:1]],

                ],
                'fethList' => [
                    ['page' => 1, 'limit' => 10],
                ],
                'add' => [
                    ['data' =>
                        [
                            'email' => 'vasia@bigTest.com',
                            'password' => '111111111',
                            'fname' => 'TESTFNAME',
                            'lname' => 'TESTLNAME',
                            'status' => 1,
                        ]
                    ]
                ],
                'delete' => [
                    ['where' => ['id' => @$_SESSION['users']['add']?:1]]
                ],
                'auth' => [
                    ['email' => 'vasia@bigTest.com', 'password' => '111111111']
                ]
            ],

            'professions' => [
                'getItem' => [
                    ['where' => ['id' => @$_SESSION['professions']['add']?:1]],

                ],
                'fethList' => [
                    ['page' => 1, 'limit' => 10],
                ],
                'add' => [
                    ['data' =>
                        [
                            'title' => 'TESTTITLE',
                        ]
                    ]
                ],
                'delete' => [
                    ['where' => ['id' => @$_SESSION['professions']['add']?:1]]
                ]
            ],

            'users_address' => [
                'getItem' => [
                    ['where' => ['id' => @$_SESSION['users_address']['add']?:1]],

                ],
                'fethList' => [
                    ['page' => 1, 'limit' => 10, 'status' => 0],
                ],
                'add' => [
                    ['data' =>
                        [
                            'id_user' =>  @$_SESSION['users']['add']?:1,
                            'address' => 'TEST ADDRESS',
                        ]
                    ]
                ],
                'delete' => [
                    ['where' => ['id' => @$_SESSION['users_address']['add']?:1]]
                ]
            ],

            'users_profession' => [
                'getItem' => [
                    ['where' => ['id' => @$_SESSION['users_profession']['add']?:1]],

                ],
                'fethList' => [
                    ['page' => 1, 'limit' => 10, 'status' => 0],
                ],
                'add' => [
                    ['data' =>
                        [
                            'price' => 1111,
                            'experience' => '1 год',
                            'description' => 'Просто ТЕСТ',
                        ]
                    ]
                ],
                'delete' => [
                    ['where' => ['id' => @$_SESSION['users_profession']['add']?:1]]
                ]
            ],
        ];

        if (isset($data[$class][$method][$count]))
            $result = $data[$class][$method][$count];

        return $result;
    }

}