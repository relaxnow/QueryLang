<?php

namespace QueryLang\v3;

use \QueryLang\v3\Node as Node;

/**
 * Query Optimizer removes unnecessary sub-queries
 */
class Optimizer
{
    private $_query;

    public function __construct(Node\Query $query)
    {
        $this->_query = $query;
    }

    public function optimize()
    {
        $optimizedQuery = $this->_optimize($this->_query);

        if ($optimizedQuery instanceof Node\Term) {
            $query = new Node\Query();
            $query->add($optimizedQuery);
            $optimizedQuery = $query;
        }

        return $optimizedQuery;
    }

    protected function _optimize(Node\Query $query)
    {
        $terms          = $query->getTerms();
        $termCount      = count($terms);
        $subQueries     = $query->getSubQueries();
        $subQueryCount  = count($subQueries);

        // Only contains a single term
        if ($subQueryCount === 0 && $termCount === 1) {
            return $terms[0];
        }
        // Only contains a single sub-query
        else if ($subQueryCount == 1 && $termCount === 0) {
            return $this->_optimize($subQueries[0]);
        }
        else {
            $newQuery = new Node\Query($query->getOperator());

            foreach ($terms as $term) {
                $newQuery->addTerm($term);
            }

            foreach ($subQueries as $subQuery) {
                $newQuery->add($this->_optimize($subQuery));
            }

            return $newQuery;
        }
    }
}