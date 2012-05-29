<?php

namespace Tests\QueryLang\v2;

class ParserTest extends \PHPUnit_Framework_TestCase
{
    const PARSER_CLASS = '\QueryLang\v2\Parser';

    public function testParseSingleWord()
    {
        $parserClass = static::PARSER_CLASS;
        $parser = new $parserClass('parser');
        $query = $parser->parse();

        $expectedQuery = new \QueryLang\v2\Node\Query();
        $expectedQuery->addTerm(new \QueryLang\v2\Node\Term('parser'));

        $this->assertEquals($expectedQuery, $query, 'Can parse a single word');
    }

    public function testMultiTerm()
    {
        $parserClass = static::PARSER_CLASS;
        $parser = new $parserClass('parser mult1 word');
        $query = $parser->parse();

        $expectedQuery = new \QueryLang\v2\Node\Query();
        $expectedQuery->addTerm(new \QueryLang\v2\Node\Term('parser'));
        $expectedQuery->addTerm(new \QueryLang\v2\Node\Term('mult1'));
        $expectedQuery->addTerm(new \QueryLang\v2\Node\Term('word'));

        $this->assertEquals($expectedQuery, $query, 'Parsing multiple words');

    }
}