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


        if(isset($data[$class][$method][$count]))
            $result = $data[$class][$method][$count];

        return $result;
    }
}