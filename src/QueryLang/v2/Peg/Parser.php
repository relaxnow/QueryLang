<?php

namespace QueryLang\v2\Peg;

require_once __DIR__ . '/../../../../vendor/hafriedlander/php-peg/Parser.php';

class Parser extends \Parser {
    /* Query: (Term >)* */
    protected $match_Query_typestack = array('Query');
    function match_Query ($stack = array()) {
    	$matchrule = "Query"; $result = $this->construct($matchrule, $matchrule, null);
    	while (true) {
    		$res_3 = $result;
    		$pos_3 = $this->pos;
    		$_2 = NULL;
    		do {
    			$matcher = 'match_'.'Term'; $key = $matcher; $pos = $this->pos;
    			$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
    			if ($subres !== FALSE) {
    				$this->store( $result, $subres );
    			}
    			else { $_2 = FALSE; break; }
    			if (( $subres = $this->whitespace(  ) ) !== FALSE) { $result["text"] .= $subres; }
    			$_2 = TRUE; break;
    		}
    		while(0);
    		if( $_2 === FALSE) {
    			$result = $res_3;
    			$this->pos = $pos_3;
    			unset( $res_3 );
    			unset( $pos_3 );
    			break;
    		}
    	}
    	return $this->finalise($result);
    }


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