<?php

namespace QueryLang\v3\Peg;

require_once __DIR__ . '/../Node/Query.php';
require_once __DIR__ . '/../Node/Term.php';
require_once __DIR__ . '/../../../../vendor/hafriedlander/php-peg/Parser.php';

class Parser extends \Parser {
    /*!* QueryLangV3

    Query: OrQuery
    OrQuery: AndQuery ([ "OR" ] AndQuery)*
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
        $result['singular'] = true;
    }

    public function Query_OrQuery(&$result, $sub)
    {
        if (isset($result['singular']) && isset($result['query'])) {
            if ($result['term']) {
                $result['query'] = new \QueryLang\v3\Node\Query();
                $result['query']->add($result['term']);
            }
            $result['query']->add($sub['term']);
            unset($result['singular']);
        }
        else if (isset($result['singular'])) {
            if ($sub['term'] instanceof \QueryLang\v3\Node\Query) {
                $result['query'] = $sub['term'];
                $result['term'] = $sub['term'];
            }
            else {
                $result['query'] = new \QueryLang\v3\Node\Query();
                $result['query']->add($sub['term']);
            }
        }
        else {
            $result['query']->add($sub['term']);
        }
    }

    public function OrQuery__construct(&$result)
    {
        $result['singular'] = true;
    }

    public function OrQuery_AndQuery(&$result, $sub)
    {
        if (isset($result['singular']) && isset($result['term'])) {
            $query = new \QueryLang\v3\Node\Query('OR');
            $query->add($result['term']);
            $query->add($sub['term']);
            $result['term'] = $query;
            unset($result['singular']);
        }
        else if (isset($result['singular'])) {
            $result['term'] = $sub['term'];
        }
        else {
            $result['term']->add($sub['term']);
        }
    }

    public function AndQuery__construct(&$result)
    {
        $result['singular'] = true;
    }

    public function AndQuery_Term(&$result, $sub)
    {
        if (isset($result['singular']) && isset($result['term'])) {
            $query = new \QueryLang\v3\Node\Query('AND');
            $query->add($result['term']);
            $query->add($sub['term']);
            $result['term'] = $query;
            unset($result['singular']);
        }
        else if (isset($result['singular'])) {
            $result['term'] = $sub['term'];
        }
        else {
            $result['term']->add($sub['term']);
        }
    }

    public function Term_Query(&$result, $sub)
    {
        $result['term'] = $sub['query'];
    }

    public function Term_Value(&$result, $sub)
    {
        $result['term'] = new \QueryLang\v3\Node\Term($sub['text']);
    }
}