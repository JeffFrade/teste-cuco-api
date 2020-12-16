<?php

namespace App\Helpers;

class StringHelper
{
    /**
     * @param string $text
     * @param string $regex
     * @param string $replace
     * @return string|string[]|null
     */
    public static function replaceRegex(string $text, string $regex, string $replace)
    {
        return preg_replace($regex, $replace, $text);
    }
}
