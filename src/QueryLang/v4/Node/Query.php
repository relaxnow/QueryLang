<?php

namespace QueryLang\v4\Node;

class Query
{
    protected $_terms = array();

    public function addTerm(Term $term)
    {
        $this->_terms[] = $term;
    }

    public function getTerms()
    {
        return $this->_terms;
    }
}