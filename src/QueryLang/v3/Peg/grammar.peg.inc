<?php

namespace QueryLang\v3\Peg;

require_once __DIR__ . '/../Node/Query.php';
require_once __DIR__ . '/../Node/Term.php';
require_once __DIR__ . '/../../../../vendor/hafriedlander/php-peg/Parser.php';

class Parser extends \Parser {
    /*!* QueryLangV3

    Query: OrQuery
    OrQuery: AndQuery ([ OR ] AndQuery)*
    AndQuery: Term ([ AND ] Term)*
    Term: ParenLeft Query ParenRight | TermValue
    OR: "OR"
    AND: "AND"
    ParenLeft: "("
    ParenRight: ")"
    TermValue: /[\w\d]+/

    */

    /**
     * @var \QueryLang\v3\Node\Query
     */
    private $_query;

    public function parse()
    {
        $node = $this->match_Query();
        return $node['query'];
    }

    public function Query__construct(&$result)
    {
        $result['query'] = new \QueryLang\v3\Node\Query();
        var_dump(__METHOD__); var_dump(func_get_args());
    }

    public function Query_OrQuery(&$result, $sub)
    {
        var_dump(__METHOD__); var_dump(func_get_args());
        $result['query']->addSubQuery($sub['query']);
    }

    public function OrQuery__construct(&$result)
    {
        $result['query'] = new \QueryLang\v3\Node\Query();
        var_dump(__METHOD__); var_dump(func_get_args());
    }

    public function OrQuery_AndQuery(&$result, $sub)
    {
        if (isset($sub['query'])) {
            $result['query']->addSubQuery($sub['query']);
        }
        else if (isset($sub['firstTerm'])) {
            $result['query']->addTerm($sub['firstTerm']);
            unset($sub['firstTerm']);
        }
        var_dump(__METHOD__); var_dump(func_get_args());
    }

    public function AndQuery_Term(&$result, $sub)
    {
        $term = new \QueryLang\v3\Node\Term($sub['text']);
        if (isset($result['query'])) {
            $result['query']->addTerm($term);
        }
        // Second term, we can be sure this is a subquery now, so create it...
        else if (isset($result['firstTerm'])) {
            $query = new \QueryLang\v3\Node\Query('AND');
            $query->addTerm($result['firstTerm']);
            $query->addTerm($term);
            $result['query'] = $query;
        }
        // May contain a subquery
        else if (isset($sub['query'])) {
            $query = new \QueryLang\v3\Node\Query('AND');
            $query->addSubQuery($sub['query']);
            $result['query'];
        }
        // May just be a single term...
        else {
            $result['firstTerm'] = $term;
        }

        var_dump(__METHOD__); var_dump(func_get_args());
    }

    public function Term_Query(&$result, $sub)
    {
        $result['query'] = $sub['query'];
        var_dump(__METHOD__); var_dump(func_get_args());
    }
}