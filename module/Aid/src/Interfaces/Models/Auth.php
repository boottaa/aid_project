<?php
/**
 * Created by PhpStorm.
 * User: b.akhmedov
 * Date: 07.08.18
 * Time: 17:48
 */

namespace Aid\Interfaces\Models;

interface Auth
{
    public function check(string $hash, string $class, string $method): bool;
}