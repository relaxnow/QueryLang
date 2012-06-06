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
    protected $_tokenStream;

    public function __construct($input)
    {
        $lexer = new Lexer($input);
        $this->_tokenStream = $lexer->lex();
    }

    public function parse()
    {
        $query = $this->_query();

        $this->_tokenStream->expect('EOS');
        return $query;
    }

    protected function _query()
    {
        $query = new Node\Query('OR');

        $leftTerm = $this->_andQuery();
        $query->add($leftTerm);

        while ($this->_tokenStream->look()->getType() === 'OR') {
            $this->_tokenStream->expect('OR');
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

        while ($this->_tokenStream->look()->getType() === 'AND') {
            $this->_tokenStream->expect('AND');
            $rightTerm = $this->_term();
            $query->add($rightTerm);
        }

        return $query;
    }

    protected function _term()
    {
        $nextTokenType = $this->_tokenStream->look()->getType();
        if ($nextTokenType === 'LeftParen') {
            $this->_tokenStream->expect('LeftParen');
            $query = $this->_query();
            $this->_tokenStream->expect('RightParen');

            return $query;
        }
        else if ($nextTokenType === 'TermValue') {
            $termValue = $this->_tokenStream->expect('TermValue');
            return new Node\Term($termValue->getValue());
        }
        else {
            throw new SyntaxException(
                "Unexpected token '{$nextTokenType}', expecting a term or a subquery!"
            );
        }
    }
}