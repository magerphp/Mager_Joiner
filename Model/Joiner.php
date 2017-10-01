<?php

namespace Mager\Joiner\Model;

class Joiner implements JoinerInterface
{
    /**
     * @var Joiner\EavCollectionJoiner $eavCollectionJoiner
     */
    protected $eavCollectionJoiner;

    /**
     * @var mixed
     */
    protected $chosenJoiner = null;


    /**
     * Joiner constructor.
     * 
     * @param Joiner\EavCollectionJoiner $eavCollectionJoiner
     */
    public function __construct
    (
        Joiner\EavCollectionJoiner $eavCollectionJoiner
    )
    {
        $this->eavCollectionJoiner = $eavCollectionJoiner;
    }

    /**
     * Starting collection
     *
     * @param $something
     * @return mixed
     */
    public function startWith($something)
    {
        // todo detect if is an eav collection, etc, set chosen joiner
        
        $isEavCollection = true;
        if ($isEavCollection) {
            $this->chosenJoiner = $this->eavCollectionJoiner;
        }
        
        $this->chosenJoiner->startWith($something);
        return $this;
    }

    /**
     * Whether this join has a starting point
     * 
     * @throws \Exception
     */
    protected function verifyStart()
    {
        $isStarted = $this->chosenJoiner !== null;
        if (!$isStarted) {
            throw new \Exception('Mager_Joiner: Must set starting point with startWith() before calling ' . __FUNCTION__);
        }
    }

    /**
     * The table to join to
     *
     * @param $tablename
     * @return mixed
     */
    public function joinTablename($tablename)
    {
        $this->verifyStart();
        $this->chosenJoiner->joinTableName($tablename);
        return $this;
    }

    /**
     * The alias for the table to join to
     *
     * @param $alias
     * @return mixed
     */
    public function joinTableAlias($alias)
    {
        $this->verifyStart();
        $this->chosenJoiner->joinTableAlias($alias);
        return $this;
    }

    /**
     * The join direction: left, right, inner
     *
     * @param $type
     * @return mixed
     */
    public function joinType($type)
    {
        $this->verifyStart();
        $this->chosenJoiner->joinType($type);
        return $this;
    }

    /**
     * The "join on" array ['table1_joinfield' => 'table2_joinfield']
     *
     * @param $on
     * @return mixed
     */
    public function joinOn($on)
    {
        $this->verifyStart();
        $this->chosenJoiner->joinOn($on);
        return $this;
    }

    /**
     * Array of fields to select from the joined table
     *
     * @param $selectFields
     * @return mixed
     */
    public function joinSelectFields($selectFields)
    {
        $this->verifyStart();
        $this->chosenJoiner->joinSelectFields($selectFields);
        return $this;
    }

    /**
     * Do the join
     */
    public function call()
    {
        $this->verifyStart();
        $this->chosenJoiner->call();
    }
}