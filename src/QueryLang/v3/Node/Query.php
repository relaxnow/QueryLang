<?php

namespace QueryLang\v3\Node;

class Query
{
    private $_operator;
    private $_terms = array();
    private $_subQueries = array();

    public function __construct($operator = 'OR')
    {
        $this->_operator = $operator;
    }

    public function getOperator()
    {
        return $this->_operator;
    }

    /**
     *
     */
    public function add($expression)
    {
        if ($expression instanceof Term) {
            return $this->addTerm($expression);
        }
        else if ($expression instanceof Query) {
            return $this->addSubQuery($expression);
        }
        throw new \RuntimeException("Unexpected expressiontype");
    }

    public function addTerm(Term $term)
    {
        $this->_terms[] = $term;
        return $term;
    }

    public function getTerms()
    {
        return $this->_terms;
    }

    public function addSubQuery(Query $query)
    {
        $this->_subQueries[] = $query;
        return $query;
    }

    public function getSubQueries()
    {
        return $this->_subQueries;
    }
}