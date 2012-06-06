<?php

namespace QueryLang\v3;

class TokenStream
{
    private $_pos = 0;
    private $_tokens = array();

    public function __construct($tokens)
    {
        $this->_tokens = $tokens;
    }

    /**
     * @param int $pos
     * @return Token
     */
    public function look($pos = 1)
    {
        return $this->_tokens[$this->_pos + --$pos];
    }

    /**
     * @param $tokenType
     * @return Token
     * @throws SyntaxException
     */
    public function expect($tokenType)
    {
        /** @var $token Token */
        $token = $this->_tokens[$this->_pos];
        if ($token->getType() !== $tokenType) {
            $excerpt = "";
            if (isset($this->_tokens[$this->_pos - 1])) {
                $excerpt .= $this->_tokens[$this->_pos - 1]->getValue();
            }
            $excerpt .= $token->getValue();
            if (isset($this->_tokens[$this->_pos + 1])) {
                $excerpt .= $this->_tokens[$this->_pos + 1]->getValue();
            }
            var_dump($this->_tokens);

            throw new SyntaxException(
                "Unexpected token " . $token->getType() .
                    " at " . $token->getPos() .
                    ' in "' . $excerpt . '"' .
                    ", expecting: $tokenType"
            );
        }
        $this->_pos++;
        return $token;
    }
}