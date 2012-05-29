<?php

namespace Tests\QueryLang\v3;

use QueryLang\v3;

class ParserTest extends \PHPUnit_Framework_TestCase
{
    const PARSER_CLASS = '\QueryLang\v3\Parser';

    public function testParseSingleWord()
    {
        $parserClass = static::PARSER_CLASS;
        $parser = new $parserClass('parser');
        $query = $parser->parse();

        $expectedQuery = new \QueryLang\v3\Node\Query();
        $expectedQuery->addTerm(new \QueryLang\v3\Node\Term('parser'));

        $this->assertEquals($expectedQuery, $query, 'parser can parse a single word');
    }

    public function testMultiTerm()
    {
        $parserClass = static::PARSER_CLASS;
        $parser = new $parserClass('parser OR mult1 OR word');
        $query = $parser->parse();

        $expectedQuery = new \QueryLang\v3\Node\Query();
        $expectedQuery->addTerm(new \QueryLang\v3\Node\Term('parser'));
        $expectedQuery->addTerm(new \QueryLang\v3\Node\Term('mult1'));
        $expectedQuery->addTerm(new \QueryLang\v3\Node\Term('word'));

        $this->assertEquals($expectedQuery, $query, 'Parser knows to parse multiple terms');
    }

    public function testPrecedence()
    {
        $parserClass = static::PARSER_CLASS;

        $implicitPrecedenceQuery = 'c OR a AND b';
        $explicitPrecedenceQuery = 'c OR (a AND b)';

        $parser = new $parserClass($implicitPrecedenceQuery);
        $query = $parser->parse();

        $parser = new $parserClass($explicitPrecedenceQuery);
        $expectedQuery = $parser->parse();

        $this->assertEquals($expectedQuery, $query, $implicitPrecedenceQuery . '===' . $explicitPrecedenceQuery);

        $implicitPrecedenceQuery = 'a AND b OR c';
        $explicitPrecedenceQuery = '(a AND b) OR c';

        $parser = new $parserClass($implicitPrecedenceQuery);
        $query = $parser->parse();

        $parser = new $parserClass($explicitPrecedenceQuery);
        $expectedQuery = $parser->parse();

        $this->assertEquals($expectedQuery, $query, $implicitPrecedenceQuery . '===' . $explicitPrecedenceQuery);
    }
}