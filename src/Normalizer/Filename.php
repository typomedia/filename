<?php

namespace Typomedia\Normalizer;

use Normalizer;

class Filename
{
    /**
     * Make filename safe:
     * - Unicode normalize NFC
     * - Replace unsafe characters to be portable
     *
     * @see http://windows.microsoft.com/en-us/windows/file-names-extensions-faq File names and file name extensions: frequently asked questions (Windows)
     * @see https://support.apple.com/en-us/HT202808 OS X: Cross-platform filename best practices and conventions (OSX)
     * @param string $name
     * @param string $replacement
     * @return string
     */
    public static function normalize(string $name, string $replacement = '-'): string
    {
        // Unicode NFC
        // https://en.wikipedia.org/wiki/Unicode_equivalence#Normal_forms
        $name = Normalizer::normalize(trim($name), Normalizer::FORM_C);

        // OS Safe characters
        $name = str_replace(['\\', '/', '?', ':', '*', '"', '>', '<', '|'], $replacement, $name);

        // Remove multiple whithespaces
        $name = preg_replace('/\s\s+/', ' ', $name);

        // strip control chars, backspace and delete (including \r)
        return preg_replace('/[\x00-\x08\x0b-\x1f\x7f]/', '', $name);
    }
}
