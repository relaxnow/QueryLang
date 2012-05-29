<?php

namespace QueryLang\v2\Node;

class Query
{
    private $_terms = array();

    public function __construct()
    {
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
}