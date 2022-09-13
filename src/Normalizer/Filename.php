<?php

namespace Typomedia\Normalizer;

use Normalizer;
use Symfony\Component\String\UnicodeString;

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
     * @param string $replace
     * @param int $length
     * @return string
     */
    public static function normalize(string $name, int $length = 120, string $replace = '-'): string
    {
        // Unicode NFC
        // https://en.wikipedia.org/wiki/Unicode_equivalence#Normal_forms
        $name = Normalizer::normalize(trim($name), Normalizer::FORM_C);

        // OS Safe characters
        $name = str_replace(['\\', '/', '?', ':', '*', '"', '>', '<', '|'], $replace, $name);

        // Remove multiple whithespaces
        $name = preg_replace('/\s\s+/', ' ', $name);

        // strip control chars, backspace and delete (including \r)
        $name = preg_replace('/[\x00-\x08\x0b-\x1f\x7f]/', '', $name);

        return self::truncate($name, $length);
    }

    /**
     * Filename length limits:
     * - ext2    255 bytes
     * - ext3    255 bytes
     * - ext4    255 bytes
     * - XFS     255 bytes
     * - ZFS     255 bytes
     * - BTRFS   255 bytes
     * - NTFS    255 characters
     * - FAT32   8.3 (255 UCS-2 code units with VFAT LFNs)
     * - exFAT   255 UTF-16 characters
     * - HFS+    255 UTF-8 bytes
     * - APFS    255 UTF-8 bytes
     *
     * @see https://en.wikipedia.org/wiki/Comparison_of_file_systems#Limits
     * @param string $filename
     * @param int $length
     * @return string
     */
    public static function truncate(string $filename, int $length = 120): string
    {
        $string = new UnicodeString($filename);

        $filename = strtok($string->wordwrap($length), "\n");

        $string = new UnicodeString($filename);

        // truncate if string has no whitespaces and was not wrapped
        return $string->truncate($length);
    }
}
