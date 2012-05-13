<?php

namespace QueryLang\v1;

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
        preg_match('/(?<term>[\w\d]+)/', $this->_string, $matches);
        return $matches['term'];
    }
}