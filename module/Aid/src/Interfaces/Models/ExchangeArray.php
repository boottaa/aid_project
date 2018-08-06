<?php
/**
 * Created by PhpStorm.
 * User: b.akhmedov
 * Date: 04.07.18
 * Time: 13:13
 */

namespace Aid\Interfaces\Models;

interface ExchangeArray
{
    /**
     * @param array $data
     *
     * @return self
     */
    public function exchangeArray(array $data);

    /**
     * @return mixed
     */
    public function save();
}