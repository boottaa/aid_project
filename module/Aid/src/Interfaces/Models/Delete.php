<?php
/**
 * Created by PhpStorm.
 * User: b.akhmedov
 * Date: 04.07.18
 * Time: 13:13
 */

namespace Aid\Interfaces\Models;

interface Delete
{
    /**
     * @param array $where
     *
     * @return mixed
     */
    public function delete(array $where);
}