<?php

namespace Tests\QueryLang\v2;

class ParserTest extends \PHPUnit_Framework_TestCase
{
    const PARSER_CLASS = '\QueryLang\v2\Parser';

    public function testNoQuery()
    {
        $parserClass = static::PARSER_CLASS;
        $parser = new $parserClass('');
        $this->assertEmpty($parser->parse());
    }

    public function testParseSingleWord()
    {
        $parserClass = static::PARSER_CLASS;
        $parser = new $parserClass('parser');
        $query = $parser->parse();
        $this->assertEquals(array('parser'), $query);
    }

    public function testMultiTerm()
    {
        $parserClass = static::PARSER_CLASS;
        $parser = new $parserClass('parser mult1 word');
        $query = $parser->parse();
        $this->assertEquals(array('parser', 'mult1', 'word'), $query);
    }
}