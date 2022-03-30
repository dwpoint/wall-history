<?php

namespace app\helper;

class IpHelper
{

    public static function hide($ip)
    {
        if (str_contains($ip, '.') === true) {
            $array_ip = explode('.', $ip);
            return $array_ip[0] . '.' . $array_ip[1] . '.' . str_repeat('*', strlen($array_ip[2])) . '.' . str_repeat('*', strlen($array_ip[3]));
        } elseif (str_contains($ip, ':') === true) {
            $array_ip = explode(':', $ip);
            return $array_ip[0] . ':' . $array_ip[1] . ':' . $array_ip[2] . ':' . $array_ip[3] . ':****:****:****:****';
        }
        throw new \LogicException('Unsupported');
    }
}