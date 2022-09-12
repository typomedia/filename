<?php

namespace Typomedia\Normalizer\Test;

use Typomedia\Normalizer\Filename;
use PHPUnit\Framework\TestCase;

class FilenameTest extends TestCase
{
    public function provideCharacters()
    {
        return array(
            array('\\'),
            array('/'),
            array('?'),
            array(':'),
            array('*'),
            array('"'),
            array('>'),
            array('<'),
            array('|'),
        );
    }

    /**
     * @test
     * @dataProvider provideCharacters
     * @param string $char
     */
    public function replaceCharacter($char)
    {
        $name = sprintf('foo%sbar%sbaz.txt', $char, $char);
        $result = 'foo-bar-baz.txt';

        $this->assertEquals($result, Filename::normalize($name));
    }

    /**
     * @test
     * @dataProvider provideCharacters
     * @param string $char
     */
    public function replaceCharacterToSpecificCharacter($char)
    {
        $replacement = '!+';

        $name = sprintf('foo%sbar%sbaz.txt', $char, $char);
        $result = 'foo!+bar!+baz.txt';

        $this->assertEquals($result, Filename::normalize($name, $replacement));
    }

    public function testNormalizeNullByte()
    {
        $name = 'Töömurdja.jpg' . chr(0) . chr(0);
        $result = 'Töömurdja.jpg';

        $this->assertEquals($result, Filename::normalize($name));
    }

    public function testNormalizeWhitespace()
    {
        $name = ' Töömurdja.jpg';
        $result = 'Töömurdja.jpg';

        $this->assertEquals($result, Filename::normalize($name));
    }
}
