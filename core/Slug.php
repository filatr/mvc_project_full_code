<?php

class Slug
{
    public static function generate(string $string): string
    {
        $string = mb_strtolower($string, 'UTF-8');

        // Транслітерація (UA / RU)
        $map = [
            'а'=>'a','б'=>'b','в'=>'v','г'=>'g','ґ'=>'g','д'=>'d','е'=>'e','є'=>'ye',
            'ж'=>'zh','з'=>'z','и'=>'y','і'=>'i','ї'=>'yi','й'=>'y','к'=>'k','л'=>'l',
            'м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u',
            'ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ь'=>'',
            'ю'=>'yu','я'=>'ya'
        ];

        $string = strtr($string, $map);

        // Видаляємо зайве
        $string = preg_replace('/[^a-z0-9]+/', '-', $string);
        $string = trim($string, '-');

        return $string ?: uniqid();
    }
}
