<?php

namespace QueryLang\v1\Peg;

require_once __DIR__ . '/../../../../vendor/hafriedlander/php-peg/Parser.php';

class Parser extends \Parser {

    /* Term: /[\w\d]+/ */
    protected $match_Term_typestack = array('Term');
    function match_Term ($stack = array()) {
    	$matchrule = "Term"; $result = $this->construct($matchrule, $matchrule, null);
    	if (( $subres = $this->rx( '/[\w\d]+/' ) ) !== FALSE) {
    		$result["text"] .= $subres;
    		return $this->finalise($result);
    	}
    	else { return FALSE; }
    }




    public function parse()
    {
        $match = $this->match_Term();
        if (!$match) {
            return '';
        }
        return $match['text'];
    }
}