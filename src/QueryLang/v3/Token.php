<?php

namespace QueryLang\v3;

class Token
{
    private $_type;
    private $_value;
    private $_pos;

    public function __construct($type, $value, $pos)
    {
        $this->_type = $type;
        $this->_value = $value;
        $this->_pos   = $pos;
    }

    public function getType()
    {
        return $this->_type;
    }

    public function getValue()
    {
        return $this->_value;
    }

    public function getPos()
    {
        return $this->_pos;
    }
}