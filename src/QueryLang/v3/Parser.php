<?php

namespace QueryLang\v3;

use \QueryLang\v3\Node as Node;

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
        return $this->_orQuery();
    }

    protected function _orQuery()
    {
        $query = new Node\Query('OR');

        $leftTerm = $this->_andQuery();
        $query->add($leftTerm);

        while ($this->_predict()->getType() === 'OR') {
            $this->_accept('OR');
            $rightTerm = $this->_andQuery();
            $query->add($rightTerm);
        }

        return $query;
    }

    protected function _andQuery()
    {
        $query = new Node\Query('AND');

        $leftTerm = $this->_term();
        $query->add($leftTerm);

        while ($this->_predict()->getType() === 'AND') {
            $this->_accept('AND');
            $rightTerm = $this->_term();
            $query->add($rightTerm);
        }

        return $query;
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
            return new Node\Term($termValue);
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
                "Unexpected token " . $token->getType() . " at " . $token->getPos() . ", expecting: $tokenType"
            );
        }
        return $token->getValue();
    }
}