<?php

namespace QueryLang\v4\Node;

class Term
{
    private $_value;
    private $_modifier;

    public function __construct($value)
    {
        $this->_value = $value;
    }

    public function setModifier($modifier)
    {
        $this->_modifier = $modifier;
    }

    public function getModifier()
    {
        return $this->_modifier;
    }
}