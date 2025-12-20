<?php
/**
 * Генерація SEO-friendly slug
 */
class Slug {

    public static function make(string $string): string {
        $string = mb_strtolower($string, 'UTF-8');
        $string = preg_replace('/[^a-zа-я0-9]+/u', '-', $string);
        return trim($string, '-');
    }
}
