<?php

namespace QueryLang\v2\Peg;

require_once __DIR__ . '/../../../../vendor/hafriedlander/php-peg/Parser.php';

class Parser extends \Parser {
    /*!* QueryLangV2

    Query: (Term >)*
    Term: /[\w\d]+/

    */

    private $_terms = array();

    public function parse()
    {
        $this->match_Query();
        return $this->_terms;
    }

    public function Query_Term($result, $sub)
    {
        $this->_terms[] = $sub['text'];
    }
}