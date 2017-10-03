<?php

namespace Mager\Joiner\Model;

abstract class AbstractJoiner
{
    /**
     * Join types
     */
    const LEFT = 'left';
    const RIGHT = 'right';
    const INNER = 'inner';


    /**
     * @var \Magento\Framework\Data\Collection\AbstractDb|\Magento\Eav\Model\Entity\Collection\AbstractCollection $collection
     */
    protected $collection = null;

    /**
     * @var string $joinTablename
     */
    protected $joinTablename = null;

    /**
     * @var string $joinTableAlias
     */
    protected $joinTableAlias = null;

    /**
     * @var string $joinType
     */
    protected $joinType = null;

    /**
     * @var string $joinOn
     */
    protected $joinOn = null;

    /**
     * @var string $joinWhere
     */
    protected $joinWhere = null;

    /**
     * @var array $joinSelectFields
     */
    protected $joinSelectFields = null;
    
    /**
     * @var EavCollectionJoiner $eavCollectionJoiner
     */
    protected $eavCollectionJoiner;

    /**
     * @var NonEavCollectionJoiner $nonEavCollectionJoiner
     */
    protected $nonEavCollectionJoiner;


    /**
     * AbstractJoiner constructor.
     * 
     * @param EavCollectionJoiner $eavCollectionJoiner
     * @param NonEavCollectionJoiner $nonEavCollectionJoiner
     */
    public function __construct
    (
        EavCollectionJoiner $eavCollectionJoiner,
        NonEavCollectionJoiner $nonEavCollectionJoiner
    )
    {
        $this->eavCollectionJoiner = $eavCollectionJoiner;
        $this->nonEavCollectionJoiner = $nonEavCollectionJoiner;
    }
    
    /**
     * Starting collection
     * 
     * @param $collection
     * @return AbstractJoiner
     */
    public function setCollection($collection)
    {
        $this->collection = $collection;
        return $this;
    }

    /**
     * Whether this join has a starting point
     *
     * @throws \Exception
     */
    protected function verifyStart($caller)
    {
        $isStarted = $this->collection !== null;
        if (!$isStarted) {
            throw new \Exception('Mager_Joiner: Must set collection' . $caller);
        }
    }

    /**
     * The table to join to
     * 
     * @param $joinTablename
     * @return AbstractJoiner
     */
    public function setJoinTablename($joinTablename)
    {
        // todo validate
        $this->verifyStart(__FUNCTION__);
        $this->joinTablename = $joinTablename;
        return $this;
    }
    
    /**
     * The alias for the table to join to.
     * Optional.
     * 
     * @param $joinTableAlias
     * @return AbstractJoiner
     */
    public function setJoinTableAlias($joinTableAlias)
    {
        // todo validate
        $this->verifyStart(__FUNCTION__);
        $this->joinTableAlias = $joinTableAlias;
        return $this;
    }

    /**
     * The join direction: left, right, inner
     * 
     * @param $joinType
     * @return AbstractJoiner
     */
    public function setJoinType($joinType)
    {
        // todo validate
        $this->verifyStart(__FUNCTION__);
        $this->joinType = $joinType;
        return $this;
    }

    /**
     * The "join on" string 'jointable_joinfield = maintable_joinfield'
     * 
     * @param $joinOn
     * @return AbstractJoiner
     */
    public function setJoinOn($joinOn)
    {
        // todo validate
        $this->verifyStart(__FUNCTION__);
        $this->joinOn = $joinOn;
        return $this;
    }

    /**
     * Additional "join on" condition
     * Optional.
     * 
     * @param $joinWhere
     * @return AbstractJoiner
     */
    public function setJoinWhere($joinWhere)
    {
        // todo validate
        $this->verifyStart(__FUNCTION__);
        $this->joinWhere = $joinWhere;
        return $this;
    }

    /**
     * Array of fields to select from the joined table
     * 
     * @param $joinSelectFields
     * @return AbstractJoiner
     */
    public function setJoinSelectFields($joinSelectFields)
    {
        // todo validate
        $this->verifyStart(__FUNCTION__);
        $this->joinSelectFields = $joinSelectFields;
        return $this;
    }

    /**
     * Do the join
     */
    abstract public function commit();

    /**
     * Reset joiner to initial state
     */
    protected function reset()
    {
        $this->collection = null;
        $this->joinTablename = null;
        $this->joinTableAlias = null;
        $this->joinType = null;
        $this->joinOn = null;
        $this->joinWhere = null;
        $this->joinSelectFields = null;
    }
}
