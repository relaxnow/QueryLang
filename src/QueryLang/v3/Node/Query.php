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

    public function addTerm(Term $term)
    {
        $this->_terms[] = $term;
        return $term;
    }

    public function addSubQuery(Query $query)
    {
        $this->_subQueries[] = $query;
        return $query;
    }
}