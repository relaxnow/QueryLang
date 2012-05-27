<?php

namespace QueryLang\v4\Peg;

require_once __DIR__ . '/../Node/Query.php';
require_once __DIR__ . '/../Node/Term.php';
require_once __DIR__ . '/../../../../vendor/hafriedlander/php-peg/Parser.php';

class QueryLangv4 extends \Parser {
    /*!* QueryLangv4

    Query           : ( SingleQuotedTerm | DoubleQuotedTerm | Term ) > Query*
    SingleQuotedTerm: Modifier* "'" term:/[^']+/ "'"
    DoubleQuotedTerm: Modifier* '"' term:/[^"]+/ '"'
    Term            : Modifier* TermValue
    Modifier        : /[+-]/
    TermValue       : /[\w\d]+/

    */

    /**
     * @var \QueryLang\v4\Node\Query
     */
    private $_query;

    public function parse()
    {
        $this->_query = new \QueryLang\v4\Node\Query();

        $this->match_Query();

        return $this->_query;
    }

    public function Query_Term(&$result, $sub)
    {
        $term = new \QueryLang\v4\Node\Term($sub['value']);
        if (isset($sub['modifier'])) {
            $term->setModifier($sub['modifier']);
        }
        $this->_query->addTerm($term);
    }

    public function Query_SingleQuotedTerm(&$result, $sub)
    {
        $term = new \QueryLang\v4\Node\LiteralTerm($sub['value']);
        if (isset($sub['modifier'])) {
            $term->setModifier($sub['modifier']);
        }
        $this->_query->addTerm($term);
    }

    public function Query_DoubleQuotedTerm(&$result, $sub)
    {
        $term = new \QueryLang\v4\Node\LiteralTerm($sub['value']);
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

    public function SingleQuotedTerm_Modifier(&$result, $sub)
    {
        $result['modifier'] = $sub['text'];
    }

    public function SingleQuotedTerm_term(&$result, $sub)
    {
        $result['value'] = $sub['text'];
    }

    public function DoubleQuotedTerm_Modifier(&$result, $sub)
    {
        $result['modifier'] = $sub['text'];
    }

    public function DoubleQuotedTerm_term(&$result, $sub)
    {
        $result['value'] = $sub['text'];
    }
}

$parser = new QueryLangv4('a +bloody -"motherf*cking badass" query');
var_dump($parser->parse());

"a OR b AND c";
"";