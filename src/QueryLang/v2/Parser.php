<?php

namespace QueryLang\v2;

class Parser
{
    private $_input;

    public function __construct($string)
    {
        $this->_input = $string;
    }

    public function parse()
    {
        return $this->_query();
    }

    protected function _query()
    {
        $query = new \QueryLang\v2\Node\Query();
        $query->addTerm($this->_term());
        while (preg_match('/\s+/', $this->_input[0])) {
            $this->_accept('\s+');
            $query->addTerm($this->_term());
        }
        return $query;
    }

    protected function _term()
    {
        $value = $this->_accept('[\w\d]+');
        return new \QueryLang\v2\Node\Term($value);
    }

    protected function _accept($regex)
    {
        $matches = array();
        $matched = preg_match("/$regex/", $this->_input, $matches);
        if (!$matched) {
            throw new SyntaxException(
                "Token not found! Require token $regex in remaining input: {$this->_input}"
            );
        }
        $value = $matches[0];

        // Remove the matched part from the input
        $this->_input = substr($this->_input, strlen($value));

        return $value;
    }
}