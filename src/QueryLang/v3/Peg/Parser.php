<?php

namespace QueryLang\v3\Peg;

require __DIR__ . '/../Node/Query.php';
require __DIR__ . '/../Node/Term.php';
require __DIR__ . '/../../../../vendor/hafriedlander/php-peg/Parser.php';

class QueryLangV3 extends \Parser {
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


    /* Term: Modifier* TermValue */
    protected $match_Term_typestack = array('Term');
    function match_Term ($stack = array()) {
    	$matchrule = "Term"; $result = $this->construct($matchrule, $matchrule, null);
    	$_7 = NULL;
    	do {
    		while (true) {
    			$res_5 = $result;
    			$pos_5 = $this->pos;
    			$matcher = 'match_'.'Modifier'; $key = $matcher; $pos = $this->pos;
    			$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
    			if ($subres !== FALSE) {
    				$this->store( $result, $subres );
    			}
    			else {
    				$result = $res_5;
    				$this->pos = $pos_5;
    				unset( $res_5 );
    				unset( $pos_5 );
    				break;
    			}
    		}
    		$matcher = 'match_'.'TermValue'; $key = $matcher; $pos = $this->pos;
    		$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->$matcher(array_merge($stack, array($result))) ) );
    		if ($subres !== FALSE) {
    			$this->store( $result, $subres );
    		}
    		else { $_7 = FALSE; break; }
    		$_7 = TRUE; break;
    	}
    	while(0);
    	if( $_7 === TRUE ) { return $this->finalise($result); }
    	if( $_7 === FALSE) { return FALSE; }
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