<?php
namespace glen\FilenameNormalizer;

class Normalizer
{
    /**
     * @param $name
     * @param string $replacement
     * @return mixed
     */
    public static function normalize($name, $replacement = '-')
    {
        $entries = array('\\', '/', '?', ':', '*', '"', '>', '<', '|');

        return str_replace($entries, $replacement, $name);
    }
}