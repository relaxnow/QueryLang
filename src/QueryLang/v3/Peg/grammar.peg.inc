<?php

namespace QueryLang\v3\Peg;

require __DIR__ . '/../Node/Query.php';
require __DIR__ . '/../Node/Term.php';
require __DIR__ . '/../../../../vendor/hafriedlander/php-peg/Parser.php';

class QueryLangV3 extends \Parser {
    /*!* QueryLangV3

    Query: Term > Query*
    Term: Modifier* TermValue
    Modifier: /[+-]/
    TermValue: /[\w\d]+/

    */

    /**
     * @var \QueryLang\v3\Node\Query
     */
    private $_query;

    public function parse()
    {
        $this->_query = new \QueryLang\v3\Node\Query();

        $this->match_Query();

        return $this->_query;
    }

    public function Query_Term(&$result, $sub)
    {
        $term = new \QueryLang\v3\Node\Term($sub['value']);
        if (isset($sub['modifier'])) {
            $term->setModifier($sub['modifier']);
        }
        $this->_query->addTerm($term);
    }

    public function Term_TermValue(&$result, $sub)
    {
        $result['value'] = $sub['text'];
    }

    public function Term_Modifier(&$result, $sub)
    {
        $result['modifier'] = $sub['text'];
    }
}