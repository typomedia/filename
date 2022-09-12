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

        $this->assertEquals($result, Filename::normalize($name, 255, $replacement));
    }

    public function testNormalizeNullByte()
    {
        $name = 'Töömurdja.jpg' . chr(0) . chr(0);
        $result = 'Töömurdja.jpg';

        $this->assertEquals($result, Filename::normalize($name));
    }

    public function testNormalizeWhitespace()
    {
        $name = ' Töömurdja   Test      Name   ';
        $result = 'Töömurdja Test Name';

        $this->assertEquals($result, Filename::normalize($name));
    }

    public function testLongTooLongFilename()
    {
        $name = 'Lörem ipsüm dölör sit ämet, consectetur adipiscing elit.';
        $result = 'Lörem ipsüm dölör sit';

        $this->assertEquals($result, Filename::normalize($name, 21));
    }

    public function testTruncate()
    {
        $string = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.';

        $this->assertEquals('Lorem ipsum dolor sit amet, consectetur adipiscing', Filename::truncate($string, 50));

        $string = 'Lörem ipsüm dölör sit ämet, cönsectetür ädipiscing elit.';
        $this->assertEquals('Lörem ipsüm dölör sit ämet, cönsectetür ädipiscing', Filename::truncate($string, 50));

        $string = 'ALongStringWithoutSpaces';
        $this->assertEquals('ALongStringWithoutSp', Filename::truncate($string, 20));

        $string = 'ÄÄÄÄÄÜÜÜÜÜÜÖÖÖÖÖÖÖßßßßßß';
        $this->assertEquals('ÄÄÄÄÄÜÜÜÜÜÜÖÖÖÖÖÖÖßß', Filename::truncate($string, 20));

        $string = 'ÄÄÄÄÄ ÜÜÜÜÜÜ ÖÖÖÖÖÖÖ ßßßßßß';
        $this->assertEquals('ÄÄÄÄÄ ÜÜÜÜÜÜ ÖÖÖÖÖÖÖ', Filename::truncate($string, 20));
    }
}
