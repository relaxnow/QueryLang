<?php

namespace QueryLang\v3\Peg;

use \QueryLang\v3\Node as Node;

require_once __DIR__ . '/../Node/Query.php';
require_once __DIR__ . '/../Node/Term.php';
require_once __DIR__ . '/../../../../vendor/hafriedlander/php-peg/Parser.php';

class Parser extends \Parser {
    /*!* QueryLangV3

    Query: AndQuery ([ "OR" ] AndQuery)*
    AndQuery: Term ([ "AND" ] Term)*
    Term: "(" Query ")" | Value:/[\w\d]+/

    */

    public function parse()
    {
        $node = $this->match_Query();
        return $node['query'];
    }

    public function Query__construct(&$result)
    {
        $result['query'] = new Node\Query('OR');
    }

    public function Query_AndQuery(&$result, $sub)
    {
        $result['query']->add($sub['query']);
    }

    public function AndQuery__construct(&$result)
    {
        $result['query'] = new Node\Query('AND');
    }

    public function AndQuery_Term(&$result, $sub)
    {
        $result['query']->add($sub['query']);
    }

    public function Term_Query(&$result, $sub)
    {
        $result['query'] = $sub['query'];
    }

    public function Term_Value(&$result, $sub)
    {
        $result['query'] = new Node\Term($sub['text']);
    }
}