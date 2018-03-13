<?php
namespace glen\FilenameNormalizer\Test;

use glen\FilenameNormalizer\Normalizer;
use PHPUnit\Framework\TestCase;

class NormalizerTest extends TestCase
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
            array('|')
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
        $result = "foo-bar-baz.txt";

        $this->assertEquals($result, Normalizer::normalize($name));
    }

    /**
     * @test
     * @dataProvider provideCharacters
     * @param string $char
     */
    public function replaceCharacterToSpecificCharacter($char)
    {
        $replacement = "!+";

        $name = sprintf('foo%sbar%sbaz.txt', $char, $char);
        $result = "foo!+bar!+baz.txt";

        $this->assertEquals($result, Normalizer::normalize($name, $replacement));
    }
}