<?php

namespace QueryLang\v4\Peg;

require_once __DIR__ . '/../Node/Query.php';
require_once __DIR__ . '/../Node/Term.php';
require_once __DIR__ . '/../Node/LiteralTerm.php';
require_once __DIR__ . '/../../../../vendor/hafriedlander/php-peg/Parser.php';

class QueryLangv4 extends \Parser {
    /* Query: ( SingleQuotedTerm | DoubleQuotedTerm | Term ) > Query* */
    protected $match_Query_typestack = array('Query');
    function match_Query ($stack = array()) {
    	$matchrule = "Query"; $result = $this->construct($matchrule, $matchrule, null);
    	$_13 = NULL;
    	do {
    		$_9 = NULL;
    		do {
    			$_7 = NULL;
    			do {
    				$res_0 = $result;
    				$pos_0 = $this->pos;
    				$matcher = 'match_'.'SingleQuotedTerm'; $key = $matcher; $pos = $this->pos;
    				$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
    				if ($subres !== FALSE) {
    					$this->store( $result, $subres );
    					$_7 = TRUE; break;
    				}
    				$result = $res_0;
    				$this->pos = $pos_0;
    				$_5 = NULL;
    				do {
    					$res_2 = $result;
    					$pos_2 = $this->pos;
    					$matcher = 'match_'.'DoubleQuotedTerm'; $key = $matcher; $pos = $this->pos;
    					$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
    					if ($subres !== FALSE) {
    						$this->store( $result, $subres );
    						$_5 = TRUE; break;
    					}
    					$result = $res_2;
    					$this->pos = $pos_2;
    					$matcher = 'match_'.'Term'; $key = $matcher; $pos = $this->pos;
    					$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
    					if ($subres !== FALSE) {
    						$this->store( $result, $subres );
    						$_5 = TRUE; break;
    					}
    					$result = $res_2;
    					$this->pos = $pos_2;
    					$_5 = FALSE; break;
    				}
    				while(0);
    				if( $_5 === TRUE ) { $_7 = TRUE; break; }
    				$result = $res_0;
    				$this->pos = $pos_0;
    				$_7 = FALSE; break;
    			}
    			while(0);
    			if( $_7 === FALSE) { $_9 = FALSE; break; }
    			$_9 = TRUE; break;
    		}
    		while(0);
    		if( $_9 === FALSE) { $_13 = FALSE; break; }
    		if (( $subres = $this->whitespace(  ) ) !== FALSE) { $result["text"] .= $subres; }
    		while (true) {
    			$res_12 = $result;
    			$pos_12 = $this->pos;
    			$matcher = 'match_'.'Query'; $key = $matcher; $pos = $this->pos;
    			$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
    			if ($subres !== FALSE) {
    				$this->store( $result, $subres );
    			}
    			else {
    				$result = $res_12;
    				$this->pos = $pos_12;
    				unset( $res_12 );
    				unset( $pos_12 );
    				break;
    			}
    		}
    		$_13 = TRUE; break;
    	}
    	while(0);
    	if( $_13 === TRUE ) { return $this->finalise($result); }
    	if( $_13 === FALSE) { return FALSE; }
    }


    /* SingleQuotedTerm: Modifier* "'" term:/[^']+/ "'" */
    protected $match_SingleQuotedTerm_typestack = array('SingleQuotedTerm');
    function match_SingleQuotedTerm ($stack = array()) {
    	$matchrule = "SingleQuotedTerm"; $result = $this->construct($matchrule, $matchrule, null);
    	$_19 = NULL;
    	do {
    		while (true) {
    			$res_15 = $result;
    			$pos_15 = $this->pos;
    			$matcher = 'match_'.'Modifier'; $key = $matcher; $pos = $this->pos;
    			$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
    			if ($subres !== FALSE) {
    				$this->store( $result, $subres );
    			}
    			else {
    				$result = $res_15;
    				$this->pos = $pos_15;
    				unset( $res_15 );
    				unset( $pos_15 );
    				break;
    			}
    		}
    		if (substr($this->string,$this->pos,1) == '\'') {
    			$this->pos += 1;
    			$result["text"] .= '\'';
    		}
    		else { $_19 = FALSE; break; }
    		$stack[] = $result; $result = $this->construct( $matchrule, "term" ); 
    		if (( $subres = $this->rx( '/[^\']+/' ) ) !== FALSE) {
    			$result["text"] .= $subres;
    			$subres = $result; $result = array_pop($stack);
    			$this->store( $result, $subres, 'term' );
    		}
    		else {
    			$result = array_pop($stack);
    			$_19 = FALSE; break;
    		}
    		if (substr($this->string,$this->pos,1) == '\'') {
    			$this->pos += 1;
    			$result["text"] .= '\'';
    		}
    		else { $_19 = FALSE; break; }
    		$_19 = TRUE; break;
    	}
    	while(0);
    	if( $_19 === TRUE ) { return $this->finalise($result); }
    	if( $_19 === FALSE) { return FALSE; }
    }


    /* DoubleQuotedTerm: Modifier* '"' term:/[^"]+/ '"' */
    protected $match_DoubleQuotedTerm_typestack = array('DoubleQuotedTerm');
    function match_DoubleQuotedTerm ($stack = array()) {
    	$matchrule = "DoubleQuotedTerm"; $result = $this->construct($matchrule, $matchrule, null);
    	$_25 = NULL;
    	do {
    		while (true) {
    			$res_21 = $result;
    			$pos_21 = $this->pos;
    			$matcher = 'match_'.'Modifier'; $key = $matcher; $pos = $this->pos;
    			$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
    			if ($subres !== FALSE) {
    				$this->store( $result, $subres );
    			}
    			else {
    				$result = $res_21;
    				$this->pos = $pos_21;
    				unset( $res_21 );
    				unset( $pos_21 );
    				break;
    			}
    		}
    		if (substr($this->string,$this->pos,1) == '"') {
    			$this->pos += 1;
    			$result["text"] .= '"';
    		}
    		else { $_25 = FALSE; break; }
    		$stack[] = $result; $result = $this->construct( $matchrule, "term" ); 
    		if (( $subres = $this->rx( '/[^"]+/' ) ) !== FALSE) {
    			$result["text"] .= $subres;
    			$subres = $result; $result = array_pop($stack);
    			$this->store( $result, $subres, 'term' );
    		}
    		else {
    			$result = array_pop($stack);
    			$_25 = FALSE; break;
    		}
    		if (substr($this->string,$this->pos,1) == '"') {
    			$this->pos += 1;
    			$result["text"] .= '"';
    		}
    		else { $_25 = FALSE; break; }
    		$_25 = TRUE; break;
    	}
    	while(0);
    	if( $_25 === TRUE ) { return $this->finalise($result); }
    	if( $_25 === FALSE) { return FALSE; }
    }


    /* Term: Modifier* TermValue */
    protected $match_Term_typestack = array('Term');
    function match_Term ($stack = array()) {
    	$matchrule = "Term"; $result = $this->construct($matchrule, $matchrule, null);
    	$_29 = NULL;
    	do {
    		while (true) {
    			$res_27 = $result;
    			$pos_27 = $this->pos;
    			$matcher = 'match_'.'Modifier'; $key = $matcher; $pos = $this->pos;
    			$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
    			if ($subres !== FALSE) {
    				$this->store( $result, $subres );
    			}
    			else {
    				$result = $res_27;
    				$this->pos = $pos_27;
    				unset( $res_27 );
    				unset( $pos_27 );
    				break;
    			}
    		}
    		$matcher = 'match_'.'TermValue'; $key = $matcher; $pos = $this->pos;
    		$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
    		if ($subres !== FALSE) {
    			$this->store( $result, $subres );
    		}
    		else { $_29 = FALSE; break; }
    		$_29 = TRUE; break;
    	}
    	while(0);
    	if( $_29 === TRUE ) { return $this->finalise($result); }
    	if( $_29 === FALSE) { return FALSE; }
    }


    /* Modifier: /[+-]/ */
    protected $match_Modifier_typestack = array('Modifier');
    function match_Modifier ($stack = array()) {
    	$matchrule = "Modifier"; $result = $this->construct($matchrule, $matchrule, null);
    	if (( $subres = $this->rx( '/[+-]/' ) ) !== FALSE) {
    		$result["text"] .= $subres;
    		return $this->finalise($result);
    	}
    	else { return FALSE; }
    }


    /* TermValue: /[\w\d]+/ */
    protected $match_TermValue_typestack = array('TermValue');
    function match_TermValue ($stack = array()) {
    	$matchrule = "TermValue"; $result = $this->construct($matchrule, $matchrule, null);
    	if (( $subres = $this->rx( '/[\w\d]+/' ) ) !== FALSE) {
    		$result["text"] .= $subres;
    		return $this->finalise($result);
    	}
    	else { return FALSE; }
    }




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