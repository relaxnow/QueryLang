<?php

namespace QueryLang\v3\Node;

class Term
{
    private $_value;

    public function __construct($value)
    {
        $this->_value = $value;
    }
}