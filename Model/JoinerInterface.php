<?php

namespace Mager\Joiner\Model;

interface JoinerInterface
{
    /**
     * Join types
     */
    const LEFT = 'left';
    const RIGHT = 'right';
    const INNER = 'inner';
    
    /**
     * Set starting collection
     * 
     * @param $collection
     * @return mixed
     */
    public function setCollection($collection);

    /**
     * The table to join to
     * 
     * @param $joinTablename
     * @return mixed
     */
    public function setJoinTablename($joinTablename);

    /**
     * The alias for the table to join to
     * 
     * @param $tableAlias
     * @return mixed
     */
    public function setJoinTableAlias($joinTableAlias);

    /**
     * The join direction: left, right, inner
     * 
     * @param $joinType
     * @return mixed
     */
    public function setJoinType($joinType);

    /**
     * The "join on" array ['table1_joinfield' => 'table2_joinfield']
     * 
     * @param $joinOn
     * @return mixed
     */
    public function setJoinOn($joinOn);

    /**
     * Additional "join on"(?)
     * 
     * @param $joinWhere
     * @return mixed
     */
    public function setJoinWhere($joinWhere);

    /**
     * Array of fields to select from the joined table
     * 
     * @param $joinSelectFields
     * @return mixed
     */
    public function setJoinSelectFields($joinSelectFields);

    /**
     * Do the join
     */
    public function commit();
}