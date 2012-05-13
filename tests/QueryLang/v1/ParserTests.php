<?php

namespace Tests\QueryLang\v1;

use QueryLang\v1;

class ParserTest extends \PHPUnit_Framework_TestCase
{
    public function testTerm()
    {
        $parser = new \QueryLang\v1\Parser('parser');
        $query = $parser->parse();
        $this->assertEquals(array('parser'), $query);
    }

    public function testEmpty()
    {
    }
}