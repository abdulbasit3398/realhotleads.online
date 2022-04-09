<?php


namespace App\Services;


class CloudService
{
    static function formatSize($size, $precision = 2)
    {
        $base = log($size, 1024);
        $suffixes = array('B', 'K', 'M', 'G', 'T');

        return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
    }

}
