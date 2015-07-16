<?php
namespace Kumatch\FilenameNormalizer\Test;

use Kumatch\FilenameNormalizer\Normalizer;

class NormalizerTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        parent::setUp();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }


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