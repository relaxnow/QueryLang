<?php

namespace Tests\QueryLang\v1;

class ParserTest extends \PHPUnit_Framework_TestCase
{
    const PARSER_CLASS = '\QueryLang\v1\Parser';

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
        $this->assertEquals('parser', $query);
    }
}