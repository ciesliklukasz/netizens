<?php

namespace App\Console\Core\Utils;

class Fingerprint
{
    public static function make(array $data): string
    {
        return md5(json_encode($data));
    }
}
