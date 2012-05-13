<?php

namespace QueryLang\v2\Peg;

require __DIR__ . '/../../../../vendor/hafriedlander/php-peg/Parser.php';

class QueryLangV2 extends \Parser {
    /*!* QueryLangV2

    Query: Term > Query*
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

$parser = new QueryLangV2('slipping angels devils');
var_dump($parser->parse());