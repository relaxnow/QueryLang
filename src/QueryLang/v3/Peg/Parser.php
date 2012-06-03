<?php

namespace QueryLang\v3\Peg;

use \QueryLang\v3\Node as Node;

require_once __DIR__ . '/../Node/Query.php';
require_once __DIR__ . '/../Node/Term.php';
require_once __DIR__ . '/../../../../vendor/hafriedlander/php-peg/Parser.php';

class Parser extends \Parser {
    /* Query: AndQuery ([ "OR" ] AndQuery)* */
    protected $match_Query_typestack = array('Query');
    function match_Query ($stack = array()) {
    	$matchrule = "Query"; $result = $this->construct($matchrule, $matchrule, null);
    	$_7 = NULL;
    	do {
    		$matcher = 'match_'.'AndQuery'; $key = $matcher; $pos = $this->pos;
    		$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
    		if ($subres !== FALSE) {
    			$this->store( $result, $subres );
    		}
    		else { $_7 = FALSE; break; }
    		while (true) {
    			$res_6 = $result;
    			$pos_6 = $this->pos;
    			$_5 = NULL;
    			do {
    				if (( $subres = $this->whitespace(  ) ) !== FALSE) { $result["text"] .= $subres; }
    				else { $_5 = FALSE; break; }
    				if (( $subres = $this->literal( 'OR' ) ) !== FALSE) { $result["text"] .= $subres; }
    				else { $_5 = FALSE; break; }
    				if (( $subres = $this->whitespace(  ) ) !== FALSE) { $result["text"] .= $subres; }
    				else { $_5 = FALSE; break; }
    				$matcher = 'match_'.'AndQuery'; $key = $matcher; $pos = $this->pos;
    				$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
    				if ($subres !== FALSE) {
    					$this->store( $result, $subres );
    				}
    				else { $_5 = FALSE; break; }
    				$_5 = TRUE; break;
    			}
    			while(0);
    			if( $_5 === FALSE) {
    				$result = $res_6;
    				$this->pos = $pos_6;
    				unset( $res_6 );
    				unset( $pos_6 );
    				break;
    			}
    		}
    		$_7 = TRUE; break;
    	}
    	while(0);
    	if( $_7 === TRUE ) { return $this->finalise($result); }
    	if( $_7 === FALSE) { return FALSE; }
    }


    /* AndQuery: Term ([ "AND" ] Term)* */
    protected $match_AndQuery_typestack = array('AndQuery');
    function match_AndQuery ($stack = array()) {
    	$matchrule = "AndQuery"; $result = $this->construct($matchrule, $matchrule, null);
    	$_16 = NULL;
    	do {
    		$matcher = 'match_'.'Term'; $key = $matcher; $pos = $this->pos;
    		$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
    		if ($subres !== FALSE) {
    			$this->store( $result, $subres );
    		}
    		else { $_16 = FALSE; break; }
    		while (true) {
    			$res_15 = $result;
    			$pos_15 = $this->pos;
    			$_14 = NULL;
    			do {
    				if (( $subres = $this->whitespace(  ) ) !== FALSE) { $result["text"] .= $subres; }
    				else { $_14 = FALSE; break; }
    				if (( $subres = $this->literal( 'AND' ) ) !== FALSE) { $result["text"] .= $subres; }
    				else { $_14 = FALSE; break; }
    				if (( $subres = $this->whitespace(  ) ) !== FALSE) { $result["text"] .= $subres; }
    				else { $_14 = FALSE; break; }
    				$matcher = 'match_'.'Term'; $key = $matcher; $pos = $this->pos;
    				$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
    				if ($subres !== FALSE) {
    					$this->store( $result, $subres );
    				}
    				else { $_14 = FALSE; break; }
    				$_14 = TRUE; break;
    			}
    			while(0);
    			if( $_14 === FALSE) {
    				$result = $res_15;
    				$this->pos = $pos_15;
    				unset( $res_15 );
    				unset( $pos_15 );
    				break;
    			}
    		}
    		$_16 = TRUE; break;
    	}
    	while(0);
    	if( $_16 === TRUE ) { return $this->finalise($result); }
    	if( $_16 === FALSE) { return FALSE; }
    }


    /* Term: "(" Query ")" | Value:/[\w\d]+/ */
    protected $match_Term_typestack = array('Term');
    function match_Term ($stack = array()) {
    	$matchrule = "Term"; $result = $this->construct($matchrule, $matchrule, null);
    	$_25 = NULL;
    	do {
    		$res_18 = $result;
    		$pos_18 = $this->pos;
    		$_22 = NULL;
    		do {
    			if (substr($this->string,$this->pos,1) == '(') {
    				$this->pos += 1;
    				$result["text"] .= '(';
    			}
    			else { $_22 = FALSE; break; }
    			$matcher = 'match_'.'Query'; $key = $matcher; $pos = $this->pos;
    			$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
    			if ($subres !== FALSE) {
    				$this->store( $result, $subres );
    			}
    			else { $_22 = FALSE; break; }
    			if (substr($this->string,$this->pos,1) == ')') {
    				$this->pos += 1;
    				$result["text"] .= ')';
    			}
    			else { $_22 = FALSE; break; }
    			$_22 = TRUE; break;
    		}
    		while(0);
    		if( $_22 === TRUE ) { $_25 = TRUE; break; }
    		$result = $res_18;
    		$this->pos = $pos_18;
    		$stack[] = $result; $result = $this->construct( $matchrule, "Value" ); 
    		if (( $subres = $this->rx( '/[\w\d]+/' ) ) !== FALSE) {
    			$result["text"] .= $subres;
    			$subres = $result; $result = array_pop($stack);
    			$this->store( $result, $subres, 'Value' );
    			$_25 = TRUE; break;
    		}
    		else { $result = array_pop($stack); }
    		$result = $res_18;
    		$this->pos = $pos_18;
    		$_25 = FALSE; break;
    	}
    	while(0);
    	if( $_25 === TRUE ) { return $this->finalise($result); }
    	if( $_25 === FALSE) { return FALSE; }
    }




    public function parse()
    {
        $node = $this->match_Query();
        return $node['query'];
    }

    public function Query__construct(&$result)
    {
        $result['query'] = new Node\Query('OR');
    }

    public function Query_AndQuery(&$result, $sub)
    {
        $result['query']->add($sub['query']);
    }

    public function AndQuery__construct(&$result)
    {
        $result['query'] = new Node\Query('AND');
    }

    public function AndQuery_Term(&$result, $sub)
    {
        $result['query']->add($sub['query']);
    }

    public function Term_Query(&$result, $sub)
    {
        $result['query'] = $sub['query'];
    }

    public function Term_Value(&$result, $sub)
    {
        $result['query'] = new Node\Term($sub['text']);
    }
}