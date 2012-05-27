<?php

namespace QueryLang\v1\Peg;

require_once __DIR__ . '/../../../../vendor/hafriedlander/php-peg/Parser.php';

class Parser extends \Parser {

    /*!* QueryLangV1

    Term: /[\w\d]+/

    */

    public function parse()
    {
        $match = $this->match_Term();
        if (!$match) {
            return '';
        }
        return $match['text'];
    }
}