<?php
/**
 * Created by PhpStorm.
 * User: b.akhmedov
 * Date: 04.07.18
 * Time: 13:13
 */

namespace Aid\Interfaces\Models;

use Zend\Paginator\Paginator;

interface FetchAll
{

    /**
     * @param int $status
     *
     * @return Paginator
     */
    public function fetchAll(array $where = []): Paginator;
}