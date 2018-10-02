<?php
/**
 * Created by PhpStorm.
 * User: b.akhmedov
 * Date: 02.10.18
 * Time: 10:35
 */
namespace Aid\Helpers;

trait CCoder{
    function encode($input) {
        return urlencode(gzdeflate(gzdeflate($input, 9), 9));
    }

    function decode($input) {
        $data = gzinflate(gzinflate(urldecode($input)));
        return $data;
    }
}