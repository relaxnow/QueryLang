<?php

namespace QueryLang\v1\Peg;

require __DIR__ . '/../../../../vendor/hafriedlander/php-peg/Parser.php';

class QueryLangV2 extends \Parser {
    /* Query: Term > Query* */
    protected $match_Query_typestack = array('Query');
    function match_Query ($stack = array()) {
    	$matchrule = "Query"; $result = $this->construct($matchrule, $matchrule, null);
    	$_3 = NULL;
    	do {
    		$matcher = 'match_'.'Term'; $key = $matcher; $pos = $this->pos;
    		$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
    		if ($subres !== FALSE) {
    			$this->store( $result, $subres );
    		}
    		else { $_3 = FALSE; break; }
    		if (( $subres = $this->whitespace(  ) ) !== FALSE) { $result["text"] .= $subres; }
    		while (true) {
    			$res_2 = $result;
    			$pos_2 = $this->pos;
    			$matcher = 'match_'.'Query'; $key = $matcher; $pos = $this->pos;
    			$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
    			if ($subres !== FALSE) {
    				$this->store( $result, $subres );
    			}
    			else {
    				$result = $res_2;
    				$this->pos = $pos_2;
    				unset( $res_2 );
    				unset( $pos_2 );
    				break;
    			}
    		}
    		$_3 = TRUE; break;
    	}
    	while(0);
    	if( $_3 === TRUE ) { return $this->finalise($result); }
    	if( $_3 === FALSE) { return FALSE; }
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

$parser = new QueryLangV2('slipping angels devils');
var_dump($parser->parse());