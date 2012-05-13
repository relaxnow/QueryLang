<?php

namespace QueryLang\v1\Peg;

require __DIR__ . '/../../../../vendor/hafriedlander/php-peg/Parser.php';

class QueryLangV1 extends \Parser {

    /*!* QueryLangV1

    Term: /[\w\d]+/

    */
}

$parser = new QueryLangV1('slipping');
var_dump($parser->match_Term());