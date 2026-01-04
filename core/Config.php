<?php

class Config
{
    public static function get(string $key)
    {
        $config = [
            'theme' => 'default',
        ];

        return $config[$key] ?? null;
    }
}
