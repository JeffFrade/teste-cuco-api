<?php

namespace App\Helpers;

class DateHelper
{
    /**
     * @param string $date
     * @return string
     */
    public static function formatDate(string $date)
    {
        return implode('-', array_reverse(explode('/', $date)));
    }
}
