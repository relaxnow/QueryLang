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
        $matches = array();
        preg_match_all('/(?<term>[\w\d]+)/', $this->_string, $matches);
        return $matches['term'];
    }
}