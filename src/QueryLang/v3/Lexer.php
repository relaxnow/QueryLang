<?php

namespace QueryLang\v3;

class Lexer
{
    private $_input;
    private $_pos = 0;
    private $_tokens;

    /**
     * @param string $input
     */
    public function __construct($input)
    {
        $this->_input = $input;
    }

    /**
     * @param int $pos
     * @return Token
     */
    public function lookAhead($pos = 0)
    {
        return $this->_tokens[$pos];
    }

    /**
     * @return Token
     */
    public function nextToken()
    {
        return array_shift($this->_tokens);
    }

    public function lex()
    {
        while (!empty($this->_input)) {
            if ($this->_match('LeftParen'   , '/^(\()/')) {continue;}
            if ($this->_match('RightParen'  , '/^(\))/')) {continue;}
            if ($this->_match('OR'          , '/^(OR)/i')) {continue;}
            if ($this->_match('AND'         , '/^(AND)/i')) {continue;}
            if ($this->_match('TermValue'   , '/^([\w\d]+)/i')) {continue;}
            if ($this->_match('WS'          , '/^\s+/', true)) {continue;}

            throw new SyntaxException(
                "Unrecognized character in input stream: '{$this->_input[0]}' at position " . $this->_pos
            );
        }
        $this->_tokens[] = new Token('EOS', '', $this->_pos);
    }

    protected function _match($type, $regex, $skip = false)
    {
        $matches = array();
        if (!preg_match($regex, $this->_input, $matches)) {
            return false;
        }

        if (!$skip) {
            $this->_tokens[] = new Token($type, $matches[0], $this->_pos);
        }

        $tokenLength = strlen($matches[0]);
        $this->_input = substr($this->_input, strlen($matches[0]));
        $this->_pos   += $tokenLength;

        return true;
    }
}