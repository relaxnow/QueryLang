<?php

namespace Tests\QueryLang\v2;

class ParserTest extends \PHPUnit_Framework_TestCase
{
    public function testMultiTerm()
    {
        $parser = new \QueryLang\v2\Parser('parser mult1 word');
        $query = $parser->parse();
        $this->assertEquals(array('parser', 'mult1', 'word'), $query);
    }

    public function testEmpty()
    {
    }
}