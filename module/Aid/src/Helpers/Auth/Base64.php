<?php
/**
 * Created by PhpStorm.
 * User: b.akhmedov
 * Date: 02.10.18
 * Time: 10:35
 */
namespace Aid\Helpers\Auth;

trait Base64{
    function base64_url_encode($input) {
        return strtr(base64_encode($input), '+/=', '._-');
    }

    function base64_url_decode($input) {
        return base64_decode(strtr($input, '._-', '+/='));
    }
}