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


    /* Term: "(" Query ")" | /[\w\d]+/ */
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
    		if (( $subres = $this->rx( '/[\w\d]+/' ) ) !== FALSE) {
    			$result["text"] .= $subres;
    			$_26 = TRUE; break;
    		}
    		$result = $res_19;
    		$this->pos = $pos_19;
    		$_26 = FALSE; break;
    	}
    	while(0);
    	if( $_26 === TRUE ) { return $this->finalise($result); }
    	if( $_26 === FALSE) { return FALSE; }
    }




    /**
     * @var \QueryLang\v3\Node\Query
     */
    private $_query;

    public function parse()
    {
        $node = $this->match_Query();
        return $node['query'];
    }

    public function Query__construct(&$result)
    {
        $result['query'] = new \QueryLang\v3\Node\Query();
        var_dump(__METHOD__); var_dump(func_get_args());
    }

    public function Query_OrQuery(&$result, $sub)
    {
        var_dump(__METHOD__); var_dump(func_get_args());
        $result['query']->addSubQuery($sub['query']);
    }

    public function OrQuery__construct(&$result)
    {
        $result['query'] = new \QueryLang\v3\Node\Query();
        var_dump(__METHOD__); var_dump(func_get_args());
    }

    public function OrQuery_AndQuery(&$result, $sub)
    {
        if (isset($sub['query'])) {
            $result['query']->addSubQuery($sub['query']);
        }
        else if (isset($sub['firstTerm'])) {
            $result['query']->addTerm($sub['firstTerm']);
            unset($sub['firstTerm']);
        }
        var_dump(__METHOD__); var_dump(func_get_args());
    }

    public function AndQuery_Term(&$result, $sub)
    {
        $term = new \QueryLang\v3\Node\Term($sub['text']);
        if (isset($result['query'])) {
            $result['query']->addTerm($term);
        }
        // Second term, we can be sure this is a subquery now, so create it...
        else if (isset($result['firstTerm'])) {
            $query = new \QueryLang\v3\Node\Query('AND');
            $query->addTerm($result['firstTerm']);
            $query->addTerm($term);
            $result['query'] = $query;
        }
        // May contain a subquery
        else if (isset($sub['query'])) {
            $query = new \QueryLang\v3\Node\Query('AND');
            $query->addSubQuery($sub['query']);
            $result['query'];
        }
        // May just be a single term...
        else {
            $result['firstTerm'] = $term;
        }

        var_dump(__METHOD__); var_dump(func_get_args());
    }

    public function Term_Query(&$result, $sub)
    {
        $result['query'] = $sub['query'];
        var_dump(__METHOD__); var_dump(func_get_args());
    }
}