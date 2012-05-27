<?php

namespace QueryLang\v4;

class Parser
{
    private $_string;
    private $_query;

    public function __construct($string)
    {
        $this->_string = $string;
        $this->_query = new \QueryLang\v4\Node\Query();
    }

    public function parse()
    {
        if ($term = $this->_parseSingleQuotedTerm()) {
            $this->_query->addTerm($term);
        }
        else if ($term = $this->_parseDoubleQuotedTerm()) {
            $this->_query->addTerm($term);
        }
        else if ($term = $this->_parseTerm()) {
            $this->_query->addTerm($term);
        }

        $this->parse();
    }

    protected function _parseTerm()
    {
        if ($term = $this->_consume('/^([\w\d])/')) {

        }
    }

    protected function _parseSingleQuotedTerm()
    {
        $this->_consume("/^'([^']+)'/");
    }

    protected function _parseDoubleQuotedTerm()
    {
        $this->_consume('/^"([^"]+)"/');
    }

    protected function _parseTermValue()
    {
        $this->_consume('/^([\w\d]+)/');
    }

    protected function _consume($regex)
    {
        $matches = array();
        if (preg_match($regex, $this->_string, $matches) === 0) {
            return false;
        }
        else {
            $match = $matches[0];
            $this->_string = substr($this->_string, strlen($match));
            return $match;
        }
    }
}

$parser = new Parser('a badass -"motherf*cking crazy" +parser');
var_dump($parser->parse());