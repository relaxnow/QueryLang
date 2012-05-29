<?php

namespace QueryLang\v2\Peg;

require_once __DIR__ . '/../../../../vendor/hafriedlander/php-peg/Parser.php';

class Parser extends \Parser {
    /* Query: Term (> Term)* */
    protected $match_Query_typestack = array('Query');
    function match_Query ($stack = array()) {
    	$matchrule = "Query"; $result = $this->construct($matchrule, $matchrule, null);
    	$_5 = NULL;
    	do {
    		$matcher = 'match_'.'Term'; $key = $matcher; $pos = $this->pos;
    		$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
    		if ($subres !== FALSE) {
    			$this->store( $result, $subres );
    		}
    		else { $_5 = FALSE; break; }
    		while (true) {
    			$res_4 = $result;
    			$pos_4 = $this->pos;
    			$_3 = NULL;
    			do {
    				if (( $subres = $this->whitespace(  ) ) !== FALSE) { $result["text"] .= $subres; }
    				$matcher = 'match_'.'Term'; $key = $matcher; $pos = $this->pos;
    				$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
    				if ($subres !== FALSE) {
    					$this->store( $result, $subres );
    				}
    				else { $_3 = FALSE; break; }
    				$_3 = TRUE; break;
    			}
    			while(0);
    			if( $_3 === FALSE) {
    				$result = $res_4;
    				$this->pos = $pos_4;
    				unset( $res_4 );
    				unset( $pos_4 );
    				break;
    			}
    		}
    		$_5 = TRUE; break;
    	}
    	while(0);
    	if( $_5 === TRUE ) { return $this->finalise($result); }
    	if( $_5 === FALSE) { return FALSE; }
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




    public function parse()
    {
        $result = $this->match_Query();
        return $result['query'];
    }

    public function Query__construct(&$result)
    {
        $result['query'] = new \QueryLang\v2\Node\Query();
    }

    public function Query_Term(&$result, $sub)
    {
        $term = new \QueryLang\v2\Node\Term($sub['text']);
        $result['query']->addTerm($term);
    }
}