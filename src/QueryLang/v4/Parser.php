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

    }
}