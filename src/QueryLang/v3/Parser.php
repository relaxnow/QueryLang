<?php

namespace QueryLang\v3;

/**
 * Query: OrQuery
 * OrQuery: AndQuery ([ OR ] AndQuery)*
 * AndQuery: Term ([ AND ] Term)*
 * Term: ParenLeft Query ParenRight | TermValue
 */
class Parser
{
    protected $_lexer;

    public function __construct($string)
    {
        $this->_lexer = new Lexer($string);
    }

    public function parse()
    {
        $this->_lexer->lex();

        return $this->_query();
    }

    protected function _query()
    {
        $result = $this->_orQuery();

        if (!($result instanceof \QueryLang\v3\Node\Query)) {
            $query = new \QueryLang\v3\Node\Query();
            $query->add($result);
            $result = $query;
        }

        return $result;
    }

    protected function _orQuery()
    {
        $leftTerm = $this->_andQuery();
        $query = new \QueryLang\v3\Node\Query('OR');
        $query->add($leftTerm);

        $parsed = false;
        while ($this->_predict()->getType() === 'OR') {
            $this->_accept('OR');
            $rightTerm = $this->_andQuery();
            $query->add($rightTerm);
            $parsed = true;
        }

        return $parsed ? $query : $leftTerm;
    }

    protected function _andQuery()
    {
        $leftTerm = $this->_term();
        $query = new \QueryLang\v3\Node\Query('AND');
        $query->add($leftTerm);

        $parsed = false;
        while ($this->_predict()->getType() === 'AND') {
            $this->_accept('AND');
            $rightTerm = $this->_term();
            $query->add($rightTerm);
            $parsed = true;
        }

        return $parsed ? $query : $leftTerm;
    }

    protected function _term()
    {
        $nextTokenType = $this->_predict()->getType();
        if ($nextTokenType === 'LeftParen') {
            $this->_accept('LeftParen');
            $query = $this->_query();
            $this->_accept('RightParen');

            return $query;
        }
        else if ($nextTokenType === 'TermValue') {
            $termValue = $this->_accept('TermValue');
            return new \QueryLang\v3\Node\Term($termValue);
        }
        else {
            throw new SyntaxException(
                "Unexpected token '{$nextTokenType}', expecting a term or a subquery!"
            );
        }
    }

    protected function _predict()
    {
        return $this->_lexer->lookAhead();
    }

    protected function _accept($tokenType)
    {
        $token = $this->_lexer->nextToken();
        if ($token->getType() !== $tokenType) {
            throw new SyntaxException(
                "Unexpected token at " . $this->getPos() . ", expecting: $tokenType"
            );
        }
        return $token->getValue();
    }
}