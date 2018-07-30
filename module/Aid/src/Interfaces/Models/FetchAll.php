<?php
/**
 * Created by PhpStorm.
 * User: b.akhmedov
 * Date: 04.07.18
 * Time: 13:13
 */

namespace Aid\Interfaces\Models;

interface FetchAll
{

    /**
     * @param int $status
     *
     * @return array
     */
    public function fetchAll($status = 1);
}