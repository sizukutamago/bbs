<?php
/**
 * Created by PhpStorm.
 * User: sizukutamago
 * Date: 2017/07/28
 * Time: 14:55
 */

function env(string $key, $default = null)
{
    if (getenv($key)) {
        return getenv($key);
    }

    return $default;
}