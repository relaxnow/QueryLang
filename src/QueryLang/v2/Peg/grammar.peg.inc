<?php

namespace QueryLang\v2\Peg;

use \QueryLang\v2\Node as Node;

require_once __DIR__ . '/../../../../vendor/hafriedlander/php-peg/Parser.php';

class Parser extends \Parser {
    /*!* QueryLangV2

    Query: Term (> Term)*
    Term: /[\w\d]+/

    */

    public function parse()
    {
        $result = $this->match_Query();
        return $result['query'];
    }

    public function Query__construct(&$result)
    {
        $result['query'] = new Node\Query();
    }

    public function Query_Term(&$result, $sub)
    {
        $term = new Node\Term($sub['text']);
        $result['query']->addTerm($term);
    }
}