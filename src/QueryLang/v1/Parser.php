<?php

namespace QueryLang\v1;

class Parser
{
    private $_input;

    public function __construct($string)
    {
        $this->_input = $string;
    }

    public function parse()
    {
        if ($this->_predict('[\w\d]+')) {
            return $this->_term();
        }
        else {
            return '';
        }
    }

    protected function _term()
    {
        return $this->_accept('[\w\d]+');
    }

    protected function _accept($regex)
    {
        $matches = array();
        $matched = preg_match("/^$regex/", $this->_input, $matches);
        if (!$matched) {
            throw new SyntaxException("Expecting $regex in input: {$this->_input}");
        }
        $value = $matches[0];

        $this->_input = substr($this->_input, strlen($value));

        return $value;
    }

    protected function _predict($regex)
    {
        return preg_match("/^$regex/", $this->_input) > 0;
    }
}