<?php

function slugify(string $text): string
{
    $text = mb_strtolower($text);
    $text = preg_replace('/[^a-zа-я0-9]+/u', '-', $text);
    $text = trim($text, '-');

    return $text ?: 'post';
}
