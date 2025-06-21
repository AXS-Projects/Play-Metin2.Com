<?php

namespace App\Support;

class MySQLPassword
{
    public static function hash(string $password): string
    {
        return '*' . strtoupper(sha1(sha1($password, true)));
    }

    public static function check(string $password, string $hashed): bool
    {
        return hash_equals(strtoupper($hashed), self::hash($password));
    }
}
