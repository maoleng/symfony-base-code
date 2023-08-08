<?php

namespace App\Lib;

class Helper
{

    public static function env($key)
    {
        return $_ENV[$key] ?? null;
    }

}
