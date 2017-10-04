<?php

namespace Mager\Joiner\Model\Joiner;

use Mager\Joiner\Model\JoinerInterface;
use Exception;

abstract class AbstractJoiner implements JoinerInterface
{
    /**
     * @var $collection
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
     * {@inheritdoc}
     */
    public function setCollection($collection)
    {
        $this->collection = $collection;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setJoinTablename($joinTablename)
    {
        // todo validate
        
        $this->joinTablename = $joinTablename;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setJoinTableAlias($joinTableAlias)
    {
        // todo validate
        
        $this->joinTableAlias = $joinTableAlias;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setJoinType($joinType)
    {
        // todo validate
        
        $this->joinType = $joinType;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setJoinOn($joinOn)
    {
        // todo validate
        
        $this->joinOn = $joinOn;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setJoinWhere($joinWhere)
    {
        // todo validate
        
        $this->joinWhere = $joinWhere;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setJoinSelectFields($joinSelectFields)
    {
        // todo validate
        
        $this->joinSelectFields = $joinSelectFields;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    abstract function commit();

    /**
     * Reset joiner to initial state
     * @return AbstractJoiner
     */
    protected function reset()
    {
        // todo return collection instead of $this?
        
        $this->collection = null;
        $this->joinTablename = null;
        $this->joinTableAlias = null;
        $this->joinType = null;
        $this->joinOn = null;
        $this->joinWhere = null;
        $this->joinSelectFields = null;
        return $this;
    }
}