<?php

namespace QueryLang\v3\Peg;

require_once __DIR__ . '/../Node/Query.php';
require_once __DIR__ . '/../Node/Term.php';
require_once __DIR__ . '/../../../../vendor/hafriedlander/php-peg/Parser.php';

class Parser extends \Parser {
    /* Query: OrQuery */
    protected $match_Query_typestack = array('Query');
    function match_Query ($stack = array()) {
    	$matchrule = "Query"; $result = $this->construct($matchrule, $matchrule, null);
    	$matcher = 'match_'.'OrQuery'; $key = $matcher; $pos = $this->pos;
    	$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
    	if ($subres !== FALSE) {
    		$this->store( $result, $subres );
    		return $this->finalise($result);
    	}
    	else { return FALSE; }
    }


    /* OrQuery: AndQuery ([ "OR" ] AndQuery)* */
    protected $match_OrQuery_typestack = array('OrQuery');
    function match_OrQuery ($stack = array()) {
    	$matchrule = "OrQuery"; $result = $this->construct($matchrule, $matchrule, null);
    	$_8 = NULL;
    	do {
    		$matcher = 'match_'.'AndQuery'; $key = $matcher; $pos = $this->pos;
    		$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
    		if ($subres !== FALSE) {
    			$this->store( $result, $subres );
    		}
    		else { $_8 = FALSE; break; }
    		while (true) {
    			$res_7 = $result;
    			$pos_7 = $this->pos;
    			$_6 = NULL;
    			do {
    				if (( $subres = $this->whitespace(  ) ) !== FALSE) { $result["text"] .= $subres; }
    				else { $_6 = FALSE; break; }
    				if (( $subres = $this->literal( 'OR' ) ) !== FALSE) { $result["text"] .= $subres; }
    				else { $_6 = FALSE; break; }
    				if (( $subres = $this->whitespace(  ) ) !== FALSE) { $result["text"] .= $subres; }
    				else { $_6 = FALSE; break; }
    				$matcher = 'match_'.'AndQuery'; $key = $matcher; $pos = $this->pos;
    				$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
    				if ($subres !== FALSE) {
    					$this->store( $result, $subres );
    				}
    				else { $_6 = FALSE; break; }
    				$_6 = TRUE; break;
    			}
    			while(0);
    			if( $_6 === FALSE) {
    				$result = $res_7;
    				$this->pos = $pos_7;
    				unset( $res_7 );
    				unset( $pos_7 );
    				break;
    			}
    		}
    		$_8 = TRUE; break;
    	}
    	while(0);
    	if( $_8 === TRUE ) { return $this->finalise($result); }
    	if( $_8 === FALSE) { return FALSE; }
    }


    /* AndQuery: Term ([ "AND" ] Term)* */
    protected $match_AndQuery_typestack = array('AndQuery');
    function match_AndQuery ($stack = array()) {
    	$matchrule = "AndQuery"; $result = $this->construct($matchrule, $matchrule, null);
    	$_17 = NULL;
    	do {
    		$matcher = 'match_'.'Term'; $key = $matcher; $pos = $this->pos;
    		$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
    		if ($subres !== FALSE) {
    			$this->store( $result, $subres );
    		}
    		else { $_17 = FALSE; break; }
    		while (true) {
    			$res_16 = $result;
    			$pos_16 = $this->pos;
    			$_15 = NULL;
    			do {
    				if (( $subres = $this->whitespace(  ) ) !== FALSE) { $result["text"] .= $subres; }
    				else { $_15 = FALSE; break; }
    				if (( $subres = $this->literal( 'AND' ) ) !== FALSE) { $result["text"] .= $subres; }
    				else { $_15 = FALSE; break; }
    				if (( $subres = $this->whitespace(  ) ) !== FALSE) { $result["text"] .= $subres; }
    				else { $_15 = FALSE; break; }
    				$matcher = 'match_'.'Term'; $key = $matcher; $pos = $this->pos;
    				$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
    				if ($subres !== FALSE) {
    					$this->store( $result, $subres );
    				}
    				else { $_15 = FALSE; break; }
    				$_15 = TRUE; break;
    			}
    			while(0);
    			if( $_15 === FALSE) {
    				$result = $res_16;
    				$this->pos = $pos_16;
    				unset( $res_16 );
    				unset( $pos_16 );
    				break;
    			}
    		}
    		$_17 = TRUE; break;
    	}
    	while(0);
    	if( $_17 === TRUE ) { return $this->finalise($result); }
    	if( $_17 === FALSE) { return FALSE; }
    }


    /* Term: "(" Query ")" | Value:/[\w\d]+/ */
    protected $match_Term_typestack = array('Term');
    function match_Term ($stack = array()) {
    	$matchrule = "Term"; $result = $this->construct($matchrule, $matchrule, null);
    	$_26 = NULL;
    	do {
    		$res_19 = $result;
    		$pos_19 = $this->pos;
    		$_23 = NULL;
    		do {
    			if (substr($this->string,$this->pos,1) == '(') {
    				$this->pos += 1;
    				$result["text"] .= '(';
    			}
    			else { $_23 = FALSE; break; }
    			$matcher = 'match_'.'Query'; $key = $matcher; $pos = $this->pos;
    			$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
    			if ($subres !== FALSE) {
    				$this->store( $result, $subres );
    			}
    			else { $_23 = FALSE; break; }
    			if (substr($this->string,$this->pos,1) == ')') {
    				$this->pos += 1;
    				$result["text"] .= ')';
    			}
    			else { $_23 = FALSE; break; }
    			$_23 = TRUE; break;
    		}
    		while(0);
    		if( $_23 === TRUE ) { $_26 = TRUE; break; }
    		$result = $res_19;
    		$this->pos = $pos_19;
    		$stack[] = $result; $result = $this->construct( $matchrule, "Value" ); 
    		if (( $subres = $this->rx( '/[\w\d]+/' ) ) !== FALSE) {
    			$result["text"] .= $subres;
    			$subres = $result; $result = array_pop($stack);
    			$this->store( $result, $subres, 'Value' );
    			$_26 = TRUE; break;
    		}
    		else { $result = array_pop($stack); }
    		$result = $res_19;
    		$this->pos = $pos_19;
    		$_26 = FALSE; break;
    	}
    	while(0);
    	if( $_26 === TRUE ) { return $this->finalise($result); }
    	if( $_26 === FALSE) { return FALSE; }
    }

    public function parse()
    {
        $node = $this->match_Query();
        return $node['query'];
    }

    public function Query__construct(&$result)
    {
        $result['singular'] = true;
    }

    public function Query_OrQuery(&$result, $sub)
    {
        if (isset($result['singular']) && isset($result['query'])) {
            if ($result['term']) {
                $result['query'] = new \QueryLang\v3\Node\Query();
                $result['query']->add($result['term']);
            }
            $result['query']->add($sub['term']);
            unset($result['singular']);
        }
        else if (isset($result['singular'])) {
            if ($sub['term'] instanceof \QueryLang\v3\Node\Query) {
                $result['query'] = $sub['term'];
                $result['term'] = $sub['term'];
            }
            else {
                $result['query'] = new \QueryLang\v3\Node\Query();
                $result['query']->add($sub['term']);
            }
        }
        else {
            $result['query']->add($sub['term']);
        }
    }

    public function OrQuery__construct(&$result)
    {
        $result['singular'] = true;
    }

    public function OrQuery_AndQuery(&$result, $sub)
    {
        if (isset($result['singular']) && isset($result['term'])) {
            $query = new \QueryLang\v3\Node\Query('OR');
            $query->add($result['term']);
            $query->add($sub['term']);
            $result['term'] = $query;
            unset($result['singular']);
        }
        else if (isset($result['singular'])) {
            $result['term'] = $sub['term'];
        }
        else {
            $result['term']->add($sub['term']);
        }
    }

    public function AndQuery__construct(&$result)
    {
        $result['singular'] = true;
    }

    public function AndQuery_Term(&$result, $sub)
    {
        if (isset($result['singular']) && isset($result['term'])) {
            $query = new \QueryLang\v3\Node\Query('AND');
            $query->add($result['term']);
            $query->add($sub['term']);
            $result['term'] = $query;
            unset($result['singular']);
        }
        else if (isset($result['singular'])) {
            $result['term'] = $sub['term'];
        }
        else {
            $result['term']->add($sub['term']);
        }
    }

    public function Term_Query(&$result, $sub)
    {
        $result['term'] = $sub['query'];
    }

    public function Term_Value(&$result, $sub)
    {
        $result['term'] = new \QueryLang\v3\Node\Term($sub['text']);
    }
}