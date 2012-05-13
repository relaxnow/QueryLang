<?php

namespace Tests\QueryLang\v3;

use QueryLang\v3;

class ParserTest extends \PHPUnit_Framework_TestCase
{
    public function testModifiers()
    {
        $parser = new \QueryLang\v3\Parser('c +programming');
        $query = $parser->parse();

        $expectedQuery = new \QueryLang\v3\Node\Query();

        $firstTerm = new \QueryLang\v3\Node\Term('c');
        $expectedQuery->addTerm($firstTerm);

        $secondTerm = new \QueryLang\v3\Node\Term('programming');
        $secondTerm->setModifier('+');
        $expectedQuery->addTerm($secondTerm);

        $this->assertEquals($expectedQuery, $query);
    }

    public function testEmpty()
    {
    }
}