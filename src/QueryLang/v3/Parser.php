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

        $query = $this->_query();

        return $query;
    }

    protected function _query()
    {
        $query = new \QueryLang\v3\Node\Query();
        $this->_orQuery($query);
        return $query;
    }

    protected function _orQuery(\QueryLang\v3\Node\Query $query)
    {
        $this->_andQuery($query);
        // As long as we have input...
        while ($this->_predict()->getType() === 'OR') {
            $this->_accept('OR');
            $this->_andQuery($query);
        }
    }

    protected function _andQuery(\QueryLang\v3\Node\Query $query)
    {
        $this->_term($query);
        while ($this->_predict()->getType() === 'AND') {
            $this->_accept('AND');
            $this->_term($query);
        }
    }

    protected function _term(\QueryLang\v3\Node\Query $query)
    {
        $nextTokenType = $this->_predict()->getType();
        if ($nextTokenType === 'LeftParen') {
            $this->_accept('LeftParen');
            $query->addSubQuery($this->_query());
            $this->_accept('RightParen');
        }
        else if ($nextTokenType === 'TermValue') {
            $termValue = $this->_accept('TermValue');
            $query->addTerm(new \QueryLang\v3\Node\Term($termValue));
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