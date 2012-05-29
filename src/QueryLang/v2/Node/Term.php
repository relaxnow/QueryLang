<?php

namespace QueryLang\v2\Node;

class Term
{
    private $_value;

    public function __construct($value)
    {
        $this->_value = $value;
    }
}