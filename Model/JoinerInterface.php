<?php

namespace Mager\Joiner\Model;

// todo this should be an abstract class!

// todo refactor common functions from eav and non-eav joiners here


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
    public function startWith($something);  // todo setCollection

    /**
     * The table to join to
     * 
     * @param $tablename
     * @return mixed
     */
    public function joinTablename($tablename);  // todo setTablename

    /**
     * The alias for the table to join to
     * 
     * @param $alias
     * @return mixed
     */
    public function joinTableAlias($alias);     // todo setTableAlias

    /**
     * The join direction: left, right, inner
     * 
     * @param $type
     * @return mixed
     */
    public function joinType($type);            // todo setJoinType

    /**
     * The "join on" array ['table1_joinfield' => 'table2_joinfield']
     * 
     * @param $on
     * @return mixed
     */
    public function joinOn($on);                // todo setJoinOn

    /**
     * Additional "join on"(?)
     * 
     * @param $where
     * @return mixed
     */
    public function joinWhere($where);          // todo setWhere / or setJoinWhere?

    /**
     * Array of fields to select from the joined table
     * 
     * @param $selectFields
     * @return mixed
     */
    public function joinSelectFields($selectFields);     // todo setJoinSelectFields?

    /**
     * Do the join
     */
    public function call();                         // todo exec? doJoin? doIt? commit?
}