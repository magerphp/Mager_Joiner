<?php

namespace Mager\Joiner\Model;

interface JoinerInterface
{
    const LEFT = 'left';
    const RIGHT = 'right';
    const INNER = 'inner';
    
    /**
     * Starting collection
     * 
     * @param $something
     * @return mixed
     */
    public function startWith($something);

    /**
     * The table to join to
     * 
     * @param $tablename
     * @return mixed
     */
    public function joinTablename($tablename);

    /**
     * The alias for the table to join to
     * 
     * @param $alias
     * @return mixed
     */
    public function joinTableAlias($alias);

    /**
     * The join direction: left, right, inner
     * 
     * @param $type
     * @return mixed
     */
    public function joinType($type);

    /**
     * The "join on" array ['table1_joinfield' => 'table2_joinfield']
     * 
     * @param $on
     * @return mixed
     */
    public function joinOn($on);

    /**
     * Array of fields to select from the joined table
     * 
     * @param $selectFields
     * @return mixed
     */
    public function joinSelectFields($selectFields);

    /**
     * Do the join
     */
    public function call();
}