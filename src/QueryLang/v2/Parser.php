<?php

namespace QueryLang\v2;

class Parser
{
    private $_string;

    public function __construct($string)
    {
        $this->_string = $string;
    }

    public function parse()
    {
        // Match a term
        $token = $this->_match('[\w\d]+');

        // Anything left after matching?
        if (!empty($this->_string)) {
            throw new SyntaxException('Unrecognized input: ' . $this->_string);
        }

        return $token;
    }

    protected function _match($regex)
    {
        $matches = array();
        $matched = preg_match("/^$regex/", $this->_string, $matches);
        if (!$matched) {
            return '';
        }
        $token = $matches[0];

        // consume the token from the input
        $this->_string = substr($this->_string, strlen($token));

        return $token;
    }
}