<?php

namespace QueryLang\v3;

class Parser
{
    private $_string;

    public function __construct($string)
    {
        $this->_string = $string;
    }

    public function parse()
    {
        $matches = array();
        preg_match_all('/(?<modifier>[+-]*)(?<term>[\w\d]+)/', $this->_string, $matches);

        $query = new \QueryLang\v3\Node\Query();
        foreach ($matches['term'] as $index => $term) {
            $term = new \QueryLang\v3\Node\Term($term);

            $termModifier = $matches['modifier'][$index];
            if ($termModifier) {
                $term->setModifier($termModifier);
            }

            $query->addTerm($term);
        }

        return $query;
    }
}